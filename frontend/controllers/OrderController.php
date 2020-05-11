<?php
/**
 * @link: http://www.h2o-china.com
 * @Copyright (c) 2017 E20-Framework
 * @author Biaowu Duan <codean.net@gmail.com>
 * @version 1.0
 */

namespace frontend\controllers;


use backend\models\system\ExpressCompany;
use common\models\goods\Book;
use common\models\Member;
use common\models\MemberAccountRecord;
use common\models\MemberCart;
use common\models\MemberShippingAddress;
use common\models\order\Order;
use common\models\order\OrderDetail;
use common\models\system\FreightTemplate;
use common\models\system\PaymentType;
use yii\data\Pagination;
use yii\db\Exception;
use yii\db\Transaction;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class OrderController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => [],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'create' => ['post'],
                    'confirm' => ['post'],
                    'pay' => ['post'],
                    'finish' => ['post'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        /**
         * @var Member $member
         */
        $member = \Yii::$app->user->getIdentity();
        $query = $member->getOrders();
        $pagination = new Pagination([
            'totalCount' => $query->count(),
        ]);

        return $this->render('index', [
            'pagination' => $pagination,
            'orders' => $query->orderBy(['id' => SORT_DESC])
                ->addOrderBy(['status' => SORT_ASC])
                ->offset($pagination->offset)
                ->limit($pagination->limit)
                ->all(),
            'status' => Order::formatStatus(),
        ]);
    }

    public function actionDetail($id)
    {
        $order = Order::findOne([
            'id' => $id,
            'member_id' => \Yii::$app->user->getId(),
        ]);
        if ($order === null) {
            throw new BadRequestHttpException('请求参数不合法');
        }

        $details = $order->getOrderDetails()
            ->all();
        $bookTotalPrice = 0;
        foreach ($details as $detail) {
            $bookTotalPrice += $detail->price * $detail->number;
        }

        if ($order->status >= Order::DELIVERED_STATUS) {
            $expressCompany = ExpressCompany::findOne($order->express_type);
        } else {
            $expressCompany = null;
        }

        return $this->render('detail', [
            'order' => $order,
            'details' => $details,
            'bookTotalPrice' => sprintf('%.2f', $bookTotalPrice),
            'freightPrice' => sprintf('%.2f', $order->price_count - $bookTotalPrice),
            'paymentType' => PaymentType::findOne($order->pay_type),
            'status' => Order::formatStatus(),
            'expressCompany' => $expressCompany,
        ]);
    }

    /**
     * @return string
     * @throws BadRequestHttpException
     * @throws NotFoundHttpException
     */
    public function actionCreate()
    {
        if ($count = \Yii::$app->getRequest()->getBodyParam('count')) {
            $conditions = [
                'isbn' => \Yii::$app->getRequest()->getBodyParam('isbn'),
                'status' => Book::ENABLE_STATUS,
            ];
            $book = Book::findOne($conditions);
            if ($book === null) {
                throw new NotFoundHttpException('图书不存在或已经被下架了');
            }
            if ($book->stock >= $count) {
                \Yii::$app->layout = 'order';
                return $this->render('create', [
                    'count' => $count,
                    'book' => $book,
                    'totalPrice' => sprintf('%.2f', $count * $book->price),
                ]);
            } else {
                throw new NotFoundHttpException('图书:' . $book->name . '没有足够的库存了');
            }
        }

        throw new BadRequestHttpException('请求参数不合法');
    }

    /**
     * @return string
     * @throws BadRequestHttpException
     * @throws Exception
     * @throws NotFoundHttpException
     * @throws \Throwable
     */
    public function actionConfirm()
    {
        if ($count = \Yii::$app->getRequest()->getBodyParam('count')) {
            // 购物车确认订单
            if ($bookIsbnSet = \Yii::$app->getRequest()->getBodyParam('isbn')) {
                $fromCart = true;
            } else {
                // 直接购买
                $fromCart = false;
                $bookIsbnSet = array_keys($count);
            }
            $books = Book::find()
                ->where(['isbn' => $bookIsbnSet])
                ->andWhere(['status' => Book::ENABLE_STATUS])
                ->indexBy('isbn')
                ->all();

            $bookPrices = [];
            $totalPrice = 0.00;
            $totalWeight = 0;
            foreach ($count as $isbn => $value) {
                if (!isset($books[$isbn])) {
                    throw new NotFoundHttpException('图书不存在或已经被下架了');
                }
                if ($books[$isbn]->stock < $value) {
                    throw new NotFoundHttpException('图书:' . $books[$isbn]->name .  '没有足够的库存了');
                }
                $bookPrices[$isbn] = sprintf('%.2f', $value * $books[$isbn]->price);
                $totalPrice += $bookPrices[$isbn];
                $totalWeight += $value * $books[$isbn]->weight;
            }

            /**
             * @var Member $member
             * @var MemberShippingAddress $address
             */
            $member = \Yii::$app->user->getIdentity();
            if ($addressId = (int)\Yii::$app->getRequest()->getBodyParam('address_id')) {
                if ($paymentId = (int)\Yii::$app->getRequest()->getBodyParam('payment_id')) {
                    $address = $member->getShippingAddresses()
                        ->andWhere(['id' => $addressId])
                        ->one();
                    if ($address === null) {
                        throw new BadRequestHttpException('请求参数不合法');
                    }

                    $payment = PaymentType::findOne($paymentId);
                    if ($payment === null) {
                        throw new BadRequestHttpException('请求参数不合法');
                    }

                    // 根据运费模板计算运费金额
                    $template = FreightTemplate::findOne([
                        'default' => 1,
                        'parent_id' => 0,
                    ]);
                    $orderTotalPrice = $template->calcPrice($totalWeight, $address->city_id, $address->district_id);

                    $order = new Order();
                    $order->member_id = $member->getId();
                    // 订单总金额： 图书总金额+运费
                    $order->price_count = $totalPrice + $orderTotalPrice;
                    $order->status = Order::NOT_PAYING_STATUS;
                    $order->pay_type = $payment->id;
                    $order->remark = \Yii::$app->getRequest()->getBodyParam('remark');
                    $order->name = $address->name;
                    $order->mobile = $address->mobile;
                    $order->province_id = $address->province_id;
                    $order->province_name = $address->province_name;
                    $order->city_id = $address->city_id;
                    $order->city_name = $address->city_name;
                    $order->district_id = $address->district_id;
                    $order->district_name = $address->district_name;
                    $order->zip_code = $address->remark;
                    $order->detail_address = $address->detail_address;
                    $order->create_time = date('Y-m-d H:i:s');
                    if (!$order->validate()) {
                        throw new BadRequestHttpException('请求参数不合法');
                    }

                    /**
                     * 预初始化订单拆解对象
                     * @var OrderDetail[] $detailModels
                     */
                    $detailModels = [];
                    foreach ($count as $isbn => $value) {
                        $orderDetail = new OrderDetail();
                        $orderDetail->isbn = $books[$isbn]->isbn;
                        $orderDetail->price = $books[$isbn]->price;
                        $orderDetail->number = $value;
                        $orderDetail->create_time = $order->create_time;
                        $detailModels[] = $orderDetail;
                    }

                    $transaction = Order::getDb()->beginTransaction(Transaction::SERIALIZABLE);
                    try {
                        $order->save();
                        foreach ($detailModels as $detailModel) {
                            $detailModel->order_id = $order->id;
                            $detailModel->save();
                            Book::updateAllCounters(['stock' => 0 - $detailModel->number], [
                                'isbn' => $detailModel->isbn,
                            ]);
                        }
                        $transaction->commit();
                    } catch (Exception $e) {
                        $transaction->rollBack();
                        throw $e;
                    } catch (\Throwable $e) {
                        $transaction->rollBack();
                        throw $e;
                    }

                    // 购物车流程订单，创建后清空购物车
                    if ($cartIsbnSet = \Yii::$app->getRequest()->getBodyParam('cartIsbn')) {
                        MemberCart::deleteAll([
                            'member_id' => $member->id,
                            'isbn' => $cartIsbnSet,
                        ]);
                    }

                    return $this->redirect(['status',
                        'id' => $order->id,
                    ]);
                }
            }

            \Yii::$app->layout = 'order';
            return $this->render('confirm', [
                'books' => $books,
                'count' => $count,
                'bookPrices' => $bookPrices,
                'totalPrice' => sprintf('%.2f', $totalPrice),
                'totalWeight' => $totalWeight,
                'addresses' => $member->getShippingAddresses()->all(),
                'paymentTypes' => PaymentType::find()
                    ->where(['status' => PaymentType::ENABLE_STATUS])
                    ->orderBy(['sort' => SORT_ASC])
                    ->all(),
                'fromCart' => $fromCart,
            ]);
        }

        throw new BadRequestHttpException('请求参数不合法');
    }

    /**
     * @param integer $id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionStatus($id)
    {
        $conditions = [
            'id' => $id,
            'member_id' => \Yii::$app->user->getId(),
        ];
        if ($model = Order::findOne($conditions)) {
            \Yii::$app->layout = 'order';
            return $this->render('status', [
                'model' => $model,
                'paymentTypes' => PaymentType::find()
                    ->where(['status' => PaymentType::ENABLE_STATUS])
                    ->orderBy(['sort' => SORT_ASC])
                    ->all(),
            ]);
        }

        throw new NotFoundHttpException('请求参数不合法');
    }

    /**
     * @param integer $id
     * @return string|\yii\web\Response
     * @throws BadRequestHttpException
     * @throws NotFoundHttpException
     * @throws Exception
     */
    public function actionPay($id)
    {
        $conditions = [
            'id' => $id,
            'member_id' => \Yii::$app->user->getId(),
        ];
        if ($model = Order::findOne($conditions)) {
            if ($paymentId = (int)\Yii::$app->getRequest()->getBodyParam('payment_id')) {
                $payment = PaymentType::findOne($paymentId);
                if ($payment === null) {
                    throw new BadRequestHttpException('请求参数不合法');
                }

                // 预修改订单状态
                $model->pay_type = $payment->id;
                $model->pay_time = date('Y-m-d H:i:s');
                $model->status = Order::PAY_STATUS;

                // 预存款金额支付
                if ($model->pay_type == PaymentType::DEPOSIT_PAY_TYPE) {
                    /**
                     * @var Member $member
                     */
                    $member = \Yii::$app->user->getIdentity();
                    if ($member->account < $model->price_count) {
                        throw new NotFoundHttpException('预存款金额不足，无法完成付款');
                    }

                    $accountRecord = new MemberAccountRecord();
                    $accountRecord->member_id = $model->member_id;
                    $accountRecord->type = MemberAccountRecord::TYPE_EXPENSE;
                    $accountRecord->value = $model->price_count;
                    $accountRecord->remark = '订单编号：' . $model->formatId();
                } else {
                    $accountRecord = null;
                }

                $transaction = Order::getDb()->beginTransaction(Transaction::SERIALIZABLE);
                try {
                    $model->save();
                    Member::updateAllCounters(['account' => 0 - $model->price_count], [
                        'id' => $model->member_id,
                    ]);
                    if ($accountRecord !== null) {
                        $accountRecord->save();
                    }
                    $transaction->commit();
                } catch (Exception $e) {
                    $transaction->rollBack();
                    return $this->redirect('status', [
                        'id' => $model->id,
                    ]);
                }
            }

            \Yii::$app->layout = 'order';
            return $this->render('pay', [
                'model' => $model,
                'paymentType' => PaymentType::findOne($model->pay_type),
            ]);
        }

        throw new NotFoundHttpException('请求参数不合法');
    }

    /**
     * @return array
     * @throws BadRequestHttpException
     */
    public function actionFinish()
    {
        \Yii::$app->response->format = Response::FORMAT_JSON;

        $conditions = [
            'id' => (int)\Yii::$app->getRequest()->getBodyParam('id'),
            'member_id' => \Yii::$app->user->getId(),
        ];
        if ($model = Order::findOne($conditions)) {
            $model->status = Order::CONFIRMED_STATUS;
            if ($model->save()) {
                return [
                    'code' => 200,
                    'msg' => '确认收货成功',
                ];
            } else {
                return [
                    'code' => '-1',
                    'msg' => '网络延迟，请稍后重试',
                ];
            }
        }

        throw new NotFoundHttpException('请求参数不合法');
    }

    /**
     * @return array
     * @throws BadRequestHttpException
     */
    public function actionReject()
    {
        \Yii::$app->response->format = Response::FORMAT_JSON;

        $conditions = [
            'id' => (int)\Yii::$app->getRequest()->getBodyParam('id'),
            'member_id' => \Yii::$app->user->getId(),
        ];
        if ($model = Order::findOne($conditions)) {
            $model->status = Order::REJECTED_STATUS;
            if ($model->save()) {
                return [
                    'code' => 200,
                    'msg' => '您已拒绝签收',
                ];
            } else {
                return [
                    'code' => '-1',
                    'msg' => '网络延迟，请稍后重试',
                ];
            }
        }

        throw new NotFoundHttpException('请求参数不合法');
    }
}
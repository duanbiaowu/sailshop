<?php
/**
 * @link: http://www.h2o-china.com
 * @Copyright (c) 2017 E20-Framework
 * @author Biaowu Duan <codean.net@gmail.com>
 * @version 1.0
 */

namespace frontend\controllers;


use common\models\order\Order;
use common\models\order\OrderAppraise;
use common\models\order\OrderDetail;
use yii\data\Pagination;
use yii\db\Query;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class AppraiseController extends Controller
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
//                    'create' => ['post'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $a = Order::tableName();
        $b = OrderDetail::tableName();
        $c = OrderAppraise::tableName();

        $query = Order::find()
            ->leftJoin($b, $a . '.id = ' . $b .'.order_id')
            ->leftJoin($c, $a . '.id = ' . $c .'.order_id')
            ->select([
                $a . '.id',
                $a . '.create_time',
                'COUNT(DISTINCT ' . $b . '.id) AS bCount',
                'COUNT(DISTINCT ' . $c . '.id) AS cCount',
            ])
            ->andWhere(['member_id' => \Yii::$app->user->getId()])
            ->andWhere(['status' => Order::CONFIRMED_STATUS])
            ->groupBy($a . '.id')
            ->orderBy([$a . '.id' => SORT_DESC])
            ->having(['cCount' => 0]);

        $pagination = new Pagination([
            'totalCount' => $query->count(),
        ]);

        $orders = $query->offset($pagination->getOffset())
            ->limit($pagination->getLimit())
            ->all();

        return $this->render('index', [
            'orders' => $orders,
            'pagination' => $pagination,
        ]);
    }

    public function actionRecord()
    {
        $a = Order::tableName();
        $b = OrderDetail::tableName();
        $c = OrderAppraise::tableName();

        $query = Order::find()
            ->leftJoin($b, $a . '.id = ' . $b .'.order_id')
            ->leftJoin($c, $a . '.id = ' . $c .'.order_id')
            ->select([
                $a . '.id',
                $a . '.create_time',
                'COUNT(DISTINCT ' . $b . '.id) AS bCount',
                'COUNT(DISTINCT ' . $c . '.id) AS cCount',
            ])
            ->andWhere(['member_id' => \Yii::$app->user->getId()])
            ->andWhere(['status' => Order::CONFIRMED_STATUS])
            ->groupBy($a . '.id')
            ->orderBy([$a . '.id' => SORT_DESC])
            ->having(['>', 'cCount', 0]);

        $pagination = new Pagination([
            'totalCount' => $query->count(),
        ]);

        $records = $query->asArray()
            ->indexBy('id')
            ->offset($pagination->getOffset())
            ->limit($pagination->getLimit())
            ->all();
        $orders = Order::find()
            ->where(['id' => array_keys($records)])
            ->orderBy(['id' => SORT_DESC])
            ->indexBy('id')
            ->all();

        return $this->render('record', [
            'orders' => $orders,
            'records' => $records,
            'pagination' => $pagination,
        ]);
    }

    public function actionCreate($id)
    {
        $order = $this->findOrder($id);
        $appraises = $order->getOrderAppraises()
            ->indexBy('isbn')
            ->all();

        if ($scores = \Yii::$app->getRequest()->getBodyParam('score')) {
            if ($contents = \Yii::$app->getRequest()->getBodyParam('content')) {
                foreach ($scores as $isbn => $score) {
                    if (!isset($appraises[$isbn])) {
                        $model = new OrderAppraise();
                        $model->order_id = $order->id;
                        $model->isbn = (string)$isbn;
                        $model->content = $contents[$isbn];
                        $model->score = (double)$score;
                        $model->save();
                    }
                }
                \Yii::$app->session->setFlash('success', '评价已完成');
                return $this->redirect('index');
            }
        }

        $books = [];
        foreach ($order->getOrderDetails()->all() as $detail) {
            $books[] = $detail->getIsbn0()->one();
        }

        return $this->render('create', [
            'order' => $order,
            'books' => $books,
            'appraises' => $appraises,
        ]);
    }

    public function actionAppend($id)
    {
        $order = $this->findOrder($id);
        $records = $order->getOrderAppraises()
            ->all();
        $appraises = [];
        foreach ($records as $record) {
            $appraises[$record->isbn][] = $record;
        }

        if ($scores = \Yii::$app->getRequest()->getBodyParam('score')) {
            if ($contents = \Yii::$app->getRequest()->getBodyParam('content')) {
                foreach ($scores as $isbn => $score) {
                    if (!isset($appraises[$isbn][1])) {
                        $model = new OrderAppraise();
                        $model->order_id = $order->id;
                        $model->isbn = (string)$isbn;
                        $model->content = $contents[$isbn];
                        $model->score = (double)$score;
                        $model->save();
                    }
                }
                \Yii::$app->session->setFlash('success', '追评已完成');
                return $this->redirect('record');
            }
        }

        $books = [];
        foreach ($order->getOrderDetails()->all() as $detail) {
            $books[] = $detail->getIsbn0()->one();
        }

        return $this->render('append', [
            'order' => $order,
            'books' => $books,
            'appraises' => $appraises,
            'records' => $records,
        ]);
    }

    public function actionContent($id)
    {
        $order = $this->findOrder($id);

        $appraises = $books = [];
        foreach ($order->getOrderAppraises()->all() as $record) {
            $appraises[$record->isbn][] = $record;
        }
        foreach ($order->getOrderDetails()->all() as $detail) {
            $books[] = $detail->getIsbn0()->one();
        }

        return $this->renderPartial('content', [
            'order' => $order,
            'books' => $books,
            'appraises' => $appraises,
        ]);
    }

    /**
     * @param integer $id
     * @return Order|null
     * @throws NotFoundHttpException
     */
    private function findOrder($id)
    {
        $conditions = [
            'id' => $id,
            'member_id' => \Yii::$app->user->getId(),
        ];
        if ($order = Order::findOne($conditions)) {
            return $order;
        }
        throw new NotFoundHttpException('请求参数不合法');
    }
}
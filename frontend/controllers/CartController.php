<?php
/**
 * @link: http://www.h2o-china.com
 * @Copyright (c) 2017 E20-Framework
 * @author Biaowu Duan <codean.net@gmail.com>
 * @version 1.0
 */

namespace frontend\controllers;


use common\models\goods\Book;
use common\models\Member;
use common\models\MemberCart;
use common\models\MemberShippingAddress;
use yii\db\StaleObjectException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\Response;

class CartController extends Controller
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
                    'update' => ['post'],
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    public function actionSettlement()
    {
        /**
         * @var Member $member
         * @var MemberCart[] $carts
         * @var Book $book
         */
        $member = \Yii::$app->user->getIdentity();
        $carts = $member->getCarts()
            ->all();

        $books = $bookPrices = [];
        $totalPrice = 0;
        foreach ($carts as $cart) {
            $book = $cart->getBook()
                ->one();
            $price = $book->price * $cart->count;
            $bookPrices[] = sprintf('%.2f', $price);
            $totalPrice += $price;
            $books[] = $book;
        }

        \Yii::$app->layout = 'order';

        return $this->render('settlement', [
            'carts' => $carts,
            'books' => $books,
            'bookPrices' => $bookPrices,
            'totalPrice' => sprintf('%.2f', $totalPrice),
        ]);
    }

    public function actionIndex()
    {
        /**
         * @var Member $member
         * @var MemberCart $cart
         * @var Book $book
         */
        $member = \Yii::$app->user->getIdentity();

        $result = [
            'books' => [],
            'totalPrice' => 0,
        ];
        foreach ($member->getCarts()->all() as $cart) {
            $book = $cart->getBook()
                ->andOnCondition(['status' => Book::ENABLE_STATUS])
                ->one();
            if ($book !== null) {
                $result['books'][] = [
                    'isbn' => $book->isbn,
                    'name' => $book->name,
                    'price' => $book->price,
                    'count' => $cart->count,
                    'thumbnail' => $book->thumbnail,
                ];
                $result['totalPrice'] += $book->price * $cart->count;
            }
        }
        $result['totalPrice'] = sprintf('%.2f', $result['totalPrice']);

        \Yii::$app->response->format = Response::FORMAT_JSON;
        return $result;
    }

    public function actionCreate()
    {
        $request = \Yii::$app->getRequest();
        if (($isbn = $request->getBodyParam('isbn')) && ($count = (int)$request->getBodyParam('count'))) {
            /**
             * @var Member $member
             * @var MemberCart $model
             */
            $member = \Yii::$app->user->getIdentity();
            $model = $member->getCarts()
                ->andOnCondition(['isbn' => $isbn])
                ->one();

            if ($model === null) {
                $model = new MemberCart();
                $model->member_id = $member->id;
                $model->isbn = $isbn;
                $model->count = $count;
            } else {
                $model->count += $count;
            }

            \Yii::$app->response->format = Response::FORMAT_JSON;
            if ($model->save()) {
                return [
                    'code' => 200,
                    'msg' => '图书已加入购物车',
                ];
            } else {
                return [
                    'code' => -1,
                    'msg' => '网络出现延迟，请稍后重试',
                ];
            }
        }
    }

    public function actionUpdate()
    {
        $request = \Yii::$app->getRequest();
        if (($isbn = $request->getBodyParam('isbn')) && ($count = (int)$request->getBodyParam('count'))) {
            /**
             * @var Member $member
             * @var MemberCart $model
             */
            $member = \Yii::$app->user->getIdentity();
            MemberCart::updateAll(['count' => $count], [
                'member_id' => $member->id,
                'isbn' => $isbn,
            ]);

            \Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                'code' => 200,
            ];
        }
    }

    public function actionDelete()
    {
        if ($isbn = \Yii::$app->getRequest()->getBodyParam('isbn')) {
            /**
             * @var Member $member
             * @var MemberCart $model
             */
            $member = \Yii::$app->user->getIdentity();

            try {
                $model = $member->getCarts()
                    ->andOnCondition(['isbn' => $isbn])
                    ->one()
                    ->delete();
            } catch (StaleObjectException $e) {

            } catch (\Exception $e) {}


            \Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                'code' => 200,
                'msg' => '图书已从购物车中删除',
            ];
        }
    }
}
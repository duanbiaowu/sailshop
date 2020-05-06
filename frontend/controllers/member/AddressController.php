<?php
/**
 * @link: http://www.h2o-china.com
 * @Copyright (c) 2017 E20-Framework
 * @author Biaowu Duan <codean.net@gmail.com>
 * @version 1.0
 */

namespace frontend\controllers\member;


use common\models\goods\Goods;
use common\models\Member;
use common\models\MemberShippingAddress;
use yii\data\Pagination;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class AddressController extends Controller
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
                    'delete' => ['post'],
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
        $query = $member->getShippingAddresses();
        $pagination = new Pagination([
            'totalCount' => $query->count()
        ]);

        return $this->render('index', [
            'pagination' => $pagination,
            'addresses' => $query->offset($pagination->offset)
                ->orderBy(['is_default' => SORT_DESC])
                ->addOrderBy(['id' => SORT_DESC])
                ->limit($pagination->limit)
                ->all(),
        ]);
    }

    public function actionCreate()
    {
        if (\Yii::$app->getRequest()->isPost) {
            $model = new MemberShippingAddress();
            $model->member_id = \Yii::$app->user->getId();
            if ($model->load(\Yii::$app->getRequest()->post()) && $model->validate()) {
                if ($model->save()) {
                    \Yii::$app->session->setFlash('success', '收货地址添加成功');
                } else {
                    \Yii::$app->session->setFlash('danger', '网络出现延迟，请稍后重试');
                }
            }
        }

        return $this->renderPartial('create');
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($model->load(\Yii::$app->getRequest()->post()) && $model->validate()) {
            $model->is_default = (int)\Yii::$app->getRequest()->getBodyParam('default');
            if ($model->save()) {
                \Yii::$app->session->setFlash('success', '收货地址修改成功');
            } else {
                \Yii::$app->session->setFlash('danger', '网络出现延迟，请稍后重试');
            }
        }

        return $this->renderPartial('update', [
            'model' => $model,
        ]);
    }

    public function actionDelete($id)
    {
        \Yii::$app->response->format = Response::FORMAT_JSON;
        if ($this->findModel($id)->delete()) {
            return [
                'code' => 200,
                'msg' => '收货地址删除成功',
            ];
        } else {
            return [
                'code' => -1,
                'msg' => '网络出现延迟，请稍后重试',
            ];
        }
    }

    /**
     * @param integer $id
     * @return MemberShippingAddress|null
     * @throws NotFoundHttpException
     */
    protected function findModel($id)
    {
        if (($model = MemberShippingAddress::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
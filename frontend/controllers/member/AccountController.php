<?php
/**
 * @link: http://www.h2o-china.com
 * @Copyright (c) 2017 E20-Framework
 * @author Biaowu Duan <codean.net@gmail.com>
 * @version 1.0
 */

namespace frontend\controllers\member;


use common\models\Member;
use common\models\MemberAccountRecord;
use yii\data\Pagination;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;

class AccountController extends Controller
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
                'actions' => [],
            ],
        ];
    }

    public function actionIndex()
    {
        /**
         * @var Member $member
         */
        $member = \Yii::$app->user->getIdentity();
        $query = $member->getAccountRecords();
        $pagination = new Pagination([
            'totalCount' => $query->count()
        ]);

        return $this->render('index', [
            'pagination' => $pagination,
            'records' => $query->offset($pagination->offset)
                ->orderBy(['id' => SORT_DESC])
                ->limit($pagination->limit)
                ->all(),
            'typeLabels' => MemberAccountRecord::typeLabels(),
        ]);
    }

    public function actionCreate()
    {
        if (\Yii::$app->getRequest()->isPost) {
            $record = new MemberAccountRecord();
            $record->member_id = \Yii::$app->user->getId();
            $record->type = MemberAccountRecord::TYPE_DEPOSIT;
            $record->value = (double)\Yii::$app->getRequest()->getBodyParam('value');
            $record->remark = \Yii::$app->getRequest()->getBodyParam('remark');

            if ($record->save()) {
                Member::updateAllCounters(['account' => $record->value], [
                    'id' => $record->member_id,
                ]);
                \Yii::$app->session->setFlash('success', '账户金额充值成功');
            } else {
                \Yii::$app->session->setFlash('danger', '网络出现延迟，请稍后重试');
            }

            return $this->redirect('index');
        }
    }
}
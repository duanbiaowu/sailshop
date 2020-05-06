<?php
/**
 * @link: http://www.h2o-china.com
 * @Copyright (c) 2017 E20-Framework
 * @author Biaowu Duan <codean.net@gmail.com>
 * @version 1.0
 */

namespace frontend\controllers\member;


use common\models\Member;
use common\models\order\Order;
use yii\data\Pagination;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;

class BrowseController extends Controller
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
        $query = $member->getBrowseRecord();
        $pagination = new Pagination([
            'totalCount' => $query->count(),
        ]);

        return $this->render('index', [
            'pagination' => $pagination,
            'records' => $query->orderBy(['last_time' => SORT_DESC])
                ->offset($pagination->offset)
                ->limit($pagination->limit)
                ->all(),
        ]);
    }
}
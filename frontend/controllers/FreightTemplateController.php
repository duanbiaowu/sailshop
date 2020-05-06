<?php
/**
 * @link: http://www.h2o-china.com
 * @Copyright (c) 2017 E20-Framework
 * @author Biaowu Duan <codean.net@gmail.com>
 * @version 1.0
 */

namespace frontend\controllers;


use common\models\system\FreightTemplate;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\Response;

class FreightTemplateController extends Controller
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

    public function actionCalc($weight, $cId, $dId)
    {
        $template = FreightTemplate::findOne([
            'default' => 1,
            'parent_id' => 0,
        ]);

        \Yii::$app->response->format = Response::FORMAT_JSON;
        if ($template === null) {
            return [
                'code' => '-1',
                'msg' => '当前没有运费模板，无法计算运费',
            ];
        }

        return [
            'code' => 200,
            'value' => $template->calcPrice($weight, $cId, $dId)
        ];
    }
}
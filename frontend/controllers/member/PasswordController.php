<?php
/**
 * @link: http://www.h2o-china.com
 * @Copyright (c) 2017 E20-Framework
 * @author Biaowu Duan <codean.net@gmail.com>
 * @version 1.0
 */

namespace frontend\controllers\member;


use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;

class PasswordController extends Controller
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
        return $this->render('index');
    }

    public function actionReset()
    {
        if (\Yii::$app->getRequest()->isPost) {
            $password = \Yii::$app->getRequest()->getBodyParam('oldPassword');
            if (\Yii::$app->user->getIdentity()->validatePassword($password)) {
                $password = \Yii::$app->getRequest()->getBodyParam('password');
                \Yii::$app->user->getIdentity()->setPassword($password);
                \Yii::$app->user->getIdentity()->save(false);

                \Yii::$app->session->setFlash('success', '修改登录密码成功！');
            } else {
                \Yii::$app->session->setFlash('danger', '当前密码输入错误，请重新输入');
            }
        }

        return $this->render('reset');
    }
}
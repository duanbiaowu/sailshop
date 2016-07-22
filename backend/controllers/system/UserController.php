<?php
/**
 * @name: SailShop System
 * @author: 游梦惊园
 * @link: https://github.com/duanbiaowu/sailshop
 * @blog: http://www.cnblogs.com/duanbiaowu
 * @copyright: Copyright (c) 2016 SailShop System
 * @date: 2015-10-28
 */

namespace backend\controllers\system;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use backend\models\system\ResetPasswordForm;

class UserController extends Controller
{
    public function actionPassword()
    {
        $model = new ResetPasswordForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            try {
                if ($model->resetPassword()) {
                    Yii::$app->session->setFlash('success', Yii::t('User', 'password_reset_success'));
                } else {
                    Yii::$app->session->setFlash('warning', Yii::t('User', 'password_reset_failed'));
                }
            } catch (InvalidParamException $e) {
                Yii::$app->session->setFlash('error', $e->getMessage());
            }

            return $this->refresh();
        }

        return $this->render('password', [
            'model' => $model,
        ]);
    }
}
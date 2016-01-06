<?php
/**
 * @name Launch shop system
 * @copyright Copyright (c) 2015-2099
 * @author: 游梦惊园
 * @blog: www.codean.net
 * @version 1.0
 * @date: 2015-10-26
 */

namespace backend\controllers\system;

use Yii;
use yii\web\Controller;
use yii\base\InvalidParamException;
use backend\models\system\SiteForm;
use backend\models\system\EmailForm;
use backend\models\system\OtherForm;

class SystemController extends Controller
{
    public function actionIndex()
    {
        $mysqlVersion = Yii::$app->db->createCommand('SELECT VERSION();')->queryColumn();
        return $this->render('index', [
            'mysqlVersion' => $mysqlVersion,
        ]);
    }

    /**
     * Set the site based information
     * @return string|\yii\web\Response
     */
    public function actionSite()
    {
        $model = new SiteForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->saveConfig()) {
                Yii::$app->session->setFlash('success', Yii::t('System', 'site_info_set_success'));
            } else {
                Yii::$app->session->setFlash('error', Yii::t('System', 'site_info_set_failed'));
            }

            return $this->render('site', [
                'model' => $model,
            ]);
        }

        $model->attributes = Yii::$app->params['siteBaseInfo'];

        return $this->render('site', [
            'model' => $model,
        ]);
    }

    public function actionOther()
    {
        $model = new OtherForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->saveConfig()) {
                Yii::$app->session->setFlash('success', Yii::t('System', 'other_config_set_success'));
            } else {
                Yii::$app->session->setFlash('error', Yii::t('System', 'other_config_set_failed'));
            }

            return $this->render('other', [
                'model' => $model,
            ]);
        } else {

            $model->attributes = Yii::$app->params['otherBaseInfo'];

            return $this->render('other', [
                'model' => $model,
            ]);
        }
    }

    public function actionEmail()
    {
        $model = new EmailForm();

        if (in_array(Yii::$app->request->post('type'), array_keys($model->scenarios()))) {
            $model->scenario = Yii::$app->request->post('type');
        } else {
            $model->scenario = 'save';
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->scenario == 'test') {
                try {
                    if ($model->sendMail()) {
                        Yii::$app->session->setFlash('success', Yii::t('System', 'email_send_success'));
                    } else {
                        Yii::$app->session->setFlash('error', Yii::t('System', 'email_send_failed'));
                    }
                } catch (InvalidParamException $e) {
                    Yii::$app->session->setFlash('warning', $e->getMessage());
                }
            } else {
                if ($model->saveConfig()) {
                    Yii::$app->session->setFlash('success', Yii::t('System', 'email_config_set_success'));
                } else {
                    Yii::$app->session->setFlash('error', Yii::t('System', 'email_config_set_failed'));
                }
            }

            return $this->refresh();
        }

        if ($model->attributes = Yii::$app->components['mailer']['transport']) {
            $model->address = Yii::$app->components['mailer']['transport']['host'];
            $model->fromUser = Yii::$app->components['mailer']['messageConfig']['from'][$model->username];
        }

        return $this->render('email', [
            'model' => $model,
        ]);
    }

}
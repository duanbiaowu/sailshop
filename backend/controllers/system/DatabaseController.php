<?php
/**
 * @name: SailShop System
 * @author: 游梦惊园
 * @link: https://github.com/duanbiaowu/sailshop
 * @blog: http://www.cnblogs.com/duanbiaowu
 * @copyright: Copyright (c) 2016 SailShop System
 * @date: 2015-12-16
 */

namespace backend\controllers\system;

use Yii;
use yii\web\Controller;
use yii\db\Exception;
use backend\models\system\Database;
use backend\models\system\DatabaseForm;
use yii\filters\VerbFilter;

class DatabaseController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'optimize' => ['post'],
                    'backup' => ['post'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $model = new Database();

        return $this->render('index', [
            'model' => $model,
            'tables' => $model->getStatus(),
        ]);
    }

    public function actionOptimize()
    {
        $model = new Database();

        try {
            $model->optimize();
            Yii::$app->session->setFlash('success', Yii::t('System', 'database_optimize_success'));
        } catch (Exception $e) {
            Yii::$app->session->setFlash('error', $e->getMessage());
        }

        return $this->redirect('index');
    }

    public function actionSql()
    {
        $model = new DatabaseForm();
        $model->scenario = $this->action->id;

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            try {
                Yii::$app->db->createCommand($model->sql)->execute();
                Yii::$app->session->setFlash('success', Yii::t('System', 'form_sql_execute_success'));
            } catch (Exception $e) {
                Yii::$app->session->setFlash('error', $e->getMessage());
            }

            return $this->refresh();
        }

        return $this->render('sql', [
            'model' => $model,
        ]);
    }

    public function actionBackup()
    {
        $model = new Database();

        try {
            $model->backup();
            Yii::$app->session->setFlash('success', Yii::t('System', 'database_backup_success'));
            return $this->redirect('restore');
        } catch (Exception $e) {
            Yii::$app->session->setFlash('error', $e->getMessage());
            return $this->redirect('index');
        }
    }

    public function actionRestore()
    {
        $model = new Database();

        return $this->render('restore', [
            'backupFiles' => $model->getBackupFiles(),
        ]);
    }
}
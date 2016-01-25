<?php
/**
 * @name: SailShop System
 * @author: 游梦惊园
 * @link: https://github.com/duanbiaowu/sailshop
 * @blog: http://www.cnblogs.com/duanbiaowu
 * @copyright: Copyright (c) 2016 SailShop System
 * @date: 2016-01-20
 */

namespace backend\controllers\system;

use Yii;
use yii\web\Controller;
use backend\models\system\Area;
use backend\models\system\Region;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;

class RegionController extends Controller
{
    public function behaviors()
    {
        return [
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
        return $this->render('index', [
            'regions' => Region::find()->all(),
            'provinces' => Area::getProvinces(),
        ]);
    }

    public function actionCreate()
    {
        $model = new Region();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->save()) {
                Yii::$app->session->setFlash('success', Yii::t('System', 'region_create_success'));
            } else {
                Yii::$app->session->setFlash('error', Yii::t('System', 'region_create_failed'));
            }

            return $this->redirect('index');
        }

        return $this->renderAjax('_form', [
            'model' => $model,
            'provinces' => Area::getProvinces(),
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->save()) {
                Yii::$app->session->setFlash('success', Yii::t('System', 'region_update_success'));
            } else {
                Yii::$app->session->setFlash('error', Yii::t('System', 'region_update_failed'));
            }

            return $this->redirect('index');
        }

        return $this->renderAjax('_form', [
            'model' => $model,
            'provinces' => Area::getProvinces(),
        ]);
    }

    public function actionDelete($id)
    {
        if ($this->findModel($id)->delete()) {
            Yii::$app->session->setFlash('success', Yii::t('System', 'region_delete_success'));
        } else {
            Yii::$app->session->setFlash('success', Yii::t('System', 'region_delete_failed'));
        }

        return $this->redirect('index');
    }

    /**
     * Finds the Region model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Region the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (null !== ($model = Region::findOne($id))) {
            return $model;
        } else {
            throw new NotFoundHttpException();
        }
    }
}
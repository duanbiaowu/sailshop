<?php

namespace backend\controllers\system;

use backend\models\system\Region;
use Yii;
use common\models\system\FreightTemplate;
use common\models\system\FreightTemplateSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * FreightTemplateController implements the CRUD actions for FreightTemplate model.
 */
class FreightTemplateController extends Controller
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

    /**
     * Lists all FreightTemplate models.
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render('index', [
            'freightTemplates' => (new FreightTemplate())->format(),
        ]);
    }

    /**
     * Displays a single FreightTemplate model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
            'districts' => FreightTemplate::findAll(['parent_id' => $id]),
        ]);
    }

    /**
     * Creates a new FreightTemplate model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new FreightTemplate();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'regions' => Region::format(),
                'districts' => $model->districts(),
            ]);
        }
    }

    /**
     * Updates an existing FreightTemplate model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', '运费模板更新成功');
            return $this->redirect('index');
        } else {
            return $this->render('update', [
                'model' => $model,
                'regions' => Region::format(),
                'districts' => $model->districts(),
            ]);
        }
    }

    /**
     * Deletes an existing FreightTemplate model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionDefault($id)
    {
        $model = $this->findModel($id);
        $model->setDefault();
        return $this->redirect('index');
    }

    /**
     * Finds the FreightTemplate model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return FreightTemplate the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = FreightTemplate::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

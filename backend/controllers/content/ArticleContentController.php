<?php

namespace backend\controllers\content;

use common\models\content\ArticleCategory;
use Yii;
use common\models\content\ArticleContent;
use common\models\content\ArticleContentSearch;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ArticleContentController implements the CRUD actions for ArticleContent model.
 */
class ArticleContentController extends Controller
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
     * Lists all ArticleContent models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ArticleContentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'categories' => $categories = ArticleCategory::getAllCategories(),
        ]);
    }

    /**
     * Displays a single ArticleContent model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new ArticleContent model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ArticleContent();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', '创建文章成功');
            return $this->redirect('index');
        } else {
            $categories = ArticleCategory::getAllCategories();
            $categories = ArrayHelper::toTreeStructure($categories);
            $categories = ArrayHelper::toDepthIndexStructure($categories);

            $formatCategories = [];
            foreach ($categories as $category) {
                $formatCategories[$category['id']] = str_repeat('──', $category['depth'] * 2) . $category['name'];
            }

            return $this->render('create', [
                'model' => $model,
                'categories' => $formatCategories,
            ]);
        }
    }

    /**
     * Updates an existing ArticleContent model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', '更新文章成功');
            return $this->redirect('index');
        } else {
            $categories = ArticleCategory::getAllCategories();
            $categories = ArrayHelper::toTreeStructure($categories);
            $categories = ArrayHelper::toDepthIndexStructure($categories);

            $formatCategories = [];
            foreach ($categories as $category) {
                $formatCategories[$category['id']] = str_repeat('──', $category['depth'] * 2) . $category['name'];
            }

            return $this->render('update', [
                'model' => $model,
                'categories' => $formatCategories,
            ]);
        }
    }

    /**
     * Deletes an existing ArticleContent model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        Yii::$app->session->setFlash('success', '删除文章成功');

        return $this->redirect(['index']);
    }

    /**
     * Finds the ArticleContent model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ArticleContent the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ArticleContent::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

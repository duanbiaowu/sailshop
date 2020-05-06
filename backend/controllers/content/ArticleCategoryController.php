<?php

namespace backend\controllers\content;

use Yii;
use common\models\content\ArticleCategory;
use common\models\content\ArticleCategorySearch;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ArticleCategoryController implements the CRUD actions for ArticleCategory model.
 */
class ArticleCategoryController extends Controller
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
     * Lists all ArticleCategory models.
     * @return mixed
     */
    public function actionIndex()
    {
        $categories = ArticleCategory::getAllCategories();
        $categories = ArrayHelper::toTreeStructure($categories);
        $categories = ArrayHelper::toDepthIndexStructure($categories);

        $searchModel = new ArticleCategorySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'categories' => $categories,
        ]);
    }

    /**
     * Displays a single ArticleCategory model.
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
     * Creates a new ArticleCategory model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ArticleCategory();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', '创建文章分类成功');

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
     * Updates an existing ArticleCategory model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', '更新文章分类成功');

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
     * Deletes an existing ArticleCategory model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $categories = ArticleCategory::getAllCategories();
        $categories = ArrayHelper::toTreeStructure($categories);
        $categories = ArrayHelper::toDepthIndexStructure($categories);

        $start = $length = count($categories);
        $depth = 0;
        foreach ($categories as $index => $category) {
            if ($id == $category['id']) {
                $start = $index;
                $depth = $category['depth'];
            }
        }
        while ($start++ < $length) {
            if ($categories[$start]['depth'] > $depth) {
                $this->findModel($categories[$start]['id'])->delete();
            } else {
                break;
            }
        }
        $this->findModel($id)->delete();

        Yii::$app->session->setFlash('success', '删除文章分类成功');
        return $this->redirect(['index']);
    }

    /**
     * Finds the ArticleCategory model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ArticleCategory the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ArticleCategory::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

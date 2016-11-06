<?php

namespace backend\controllers\goods;

use common\models\Available;
use common\models\goods\Attribute;
use common\models\goods\Brand;
use common\models\goods\Specifications;
use Yii;
use common\models\goods\Goods;
use common\models\goods\GoodsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\goods\Category;

/**
 * GoodsController implements the CRUD actions for Goods model.
 */
class GoodsController extends Controller
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
     * Lists all Goods models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new GoodsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Goods model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $model->status = Available::getLabel($model->status);

        return $this->render('view', [
            'model' => $model,
            'category' => Category::findOne($model->category_id)
        ]);
    }

    /**
     * Creates a new Goods model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Goods();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            $category = new Category();
            $categories = [];
            $category->arrayToList( $category->arrayToTree( $category->category() ), $categories);

            return $this->render('create', [
                'model' => $model,
                'categories' => $categories,
                'brands' => Brand::find()->asArray()->all(),
                'attributeGroup' => Attribute::find()->where(['parent_id' => 0])->asArray()->all(),
            ]);
        }
    }

    /**
     * Updates an existing Goods model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            $category = new Category();
            $categories = [];
            $category->arrayToList( $category->arrayToTree( $category->category() ), $categories);

            return $this->render('update', [
                'model' => $model,
                'categories' => $categories,
                'brands' => Brand::find()->asArray()->all(),
                'attributeGroup' => (new Attribute())->groups(false),
            ]);
        }
    }

    /**
     * Deletes an existing Goods model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionSlideForm()
    {
        return $this->renderAjax('slide_form');
    }

    public function actionSku()
    {
        return $this->renderAjax('sku_form', [
            'specs' => Specifications::specFormat(),
        ]);
    }

    /**
     * Finds the Goods model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Goods the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Goods::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

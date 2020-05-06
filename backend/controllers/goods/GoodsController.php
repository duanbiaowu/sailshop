<?php

namespace backend\controllers\goods;

use common\models\Available;
use common\models\goods\Attribute;
use common\models\goods\Author;
use common\models\goods\AuthorGoods;
use common\models\goods\Brand;
use common\models\goods\GoodsSku;
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
            'categories' => Category::find()->indexBy('id')->asArray()->all(),
            'brands' => Brand::find()->indexBy('id')->asArray()->all(),
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
            $data = Yii::$app->request->post('Goods');
            if (isset($data['author_id']) && is_array($data['author_id'])) {
                foreach ($data['author_id'] as $authorId) {
                    $authorGoods = new AuthorGoods();
                    $authorGoods->author_id = $authorId;
                    $authorGoods->goods_id = $model->id;
                    $authorGoods->save();
                }
            }

            Yii::$app->session->setFlash('success', '图书信息创建成功');
            return $this->redirect('index');
        } else {
            $category = new Category();
            $categories = [];
            $category->arrayToList( $category->arrayToTree( $category->category() ), $categories);

            return $this->render('create', [
                'model' => $model,
                'categories' => $categories,
                'brands' => Brand::find()->asArray()->all(),
                'authors' => Author::find()->asArray()->all(),
                'goodsAuthors' => $model->getGoodsAuthors()->indexBy('author_id')->all(),
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
            AuthorGoods::deleteAll(['goods_id' => $model->id]);
            $data = Yii::$app->request->post('Goods');
            if (isset($data['author_id']) && is_array($data['author_id'])) {
                foreach ($data['author_id'] as $authorId) {
                    $authorGoods = new AuthorGoods();
                    $authorGoods->author_id = $authorId;
                    $authorGoods->goods_id = $model->id;
                    $authorGoods->save();
                }
            }

            Yii::$app->session->setFlash('success', '图书信息更新成功');
            return $this->redirect('index');
        } else {
            $category = new Category();
            $categories = [];
            $category->arrayToList( $category->arrayToTree( $category->category() ), $categories);

            return $this->render('update', [
                'model' => $model,
                'categories' => $categories,
                'brands' => Brand::find()->asArray()->all(),
                'authors' => Author::find()->asArray()->all(),
                'goodsAuthors' => $model->getGoodsAuthors()->indexBy('author_id')->all(),
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
        Yii::$app->session->setFlash('success', '图书信息删除成功');
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionSlideForm()
    {
        return $this->renderAjax('slide_form');
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

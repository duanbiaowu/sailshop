<?php

namespace backend\controllers\goods;

use common\models\goods\Author;
use common\models\goods\AuthorGoods;
use common\models\goods\BookAuthor;
use common\models\goods\Brand;
use common\models\goods\Category;
use Yii;
use common\models\goods\Book;
use common\models\goods\BookSearch;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * BookController implements the CRUD actions for Book model.
 */
class BookController extends Controller
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
     * Lists all Book models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BookSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'categories' => Category::find()->indexBy('id')->asArray()->all(),
            'brands' => Brand::find()->indexBy('id')->asArray()->all(),
        ]);
    }

    /**
     * Displays a single Book model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Book model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Book();

        $data = Yii::$app->request->post();
        if ($model->load($data) && $model->save()) {
            BookAuthor::deleteAll(['isbn' => $model->isbn]);
            if (isset($data['Book']['author_id']) && is_array($data['Book']['author_id'])) {
                foreach ($data['Book']['author_id'] as $authorId) {
                    $bookAuthor = new BookAuthor();
                    $bookAuthor->isbn = $model->isbn;
                    $bookAuthor->author_id = $authorId;
                    $bookAuthor->save();
                }
            }

            Yii::$app->session->setFlash('success', '图书信息创建成功');
            return $this->redirect('index');
        } else {
            return $this->render('create', [
                'model' => $model,
                'categories' => $this->findAllCategories(),
                'brands' => Brand::find()->asArray()->all(),
                'authors' => Author::find()->asArray()->all(),
            ]);
        }
    }

    /**
     * Updates an existing Book model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $data = Yii::$app->request->post();
        if ($model->load($data) && $model->save()) {
            BookAuthor::deleteAll(['isbn' => $model->isbn]);
            if (isset($data['Book']['author_id']) && is_array($data['Book']['author_id'])) {
                foreach ($data['Book']['author_id'] as $authorId) {
                    $bookAuthor = new BookAuthor();
                    $bookAuthor->isbn = $model->isbn;
                    $bookAuthor->author_id = $authorId;
                    $bookAuthor->save();
                }
            }

            Yii::$app->session->setFlash('success', '图书信息更新成功');
            return $this->redirect('index');
        } else {
            return $this->render('update', [
                'model' => $model,
                'categories' => $this->findAllCategories(),
                'brands' => Brand::find()->asArray()->all(),
                'authors' => Author::find()->asArray()->all(),
                'bookAuthors' => $model->getAuthors()->indexBy('author_id')->asArray()->all(),
            ]);
        }
    }

    /**
     * Deletes an existing Book model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        Yii::$app->session->setFlash('success', '图书信息删除成功');
        return $this->redirect(['index']);
    }

    public function actionSlideForm()
    {
        return $this->renderAjax('slide_form');
    }

    /**
     * Finds the Book model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Book the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Book::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function findAllCategories()
    {
        $categories = Category::find()
            ->indexBy('id')
            ->asArray()
            ->all();

        $categories = ArrayHelper::toDepthIndexStructure(ArrayHelper::toTreeStructure($categories));
        $result = [];
        foreach ($categories as $category) {
            $result[$category['id']] = str_repeat('──', $category['depth']) . $category['name'];
        }
        return $result;
    }
}

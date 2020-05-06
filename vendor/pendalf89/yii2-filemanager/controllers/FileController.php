<?php

namespace pendalf89\filemanager\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use pendalf89\filemanager\Module;
use pendalf89\filemanager\models\Attachment;
use pendalf89\filemanager\assets\FilemanagerAsset;
use yii\helpers\Url;

class FileController extends Controller
{
    public $enableCsrfValidation = false;

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                    'update' => ['post'],
                ],
            ],
        ];
    }

    public function beforeAction($action)
    {
        if (defined('YII_DEBUG') && YII_DEBUG) {
            Yii::$app->assetManager->forceCopy = true;
        }

        return parent::beforeAction($action);
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionManager()
    {
        $this->layout = '@vendor/pendalf89/yii2-filemanager/views/layouts/main';

        $model = new Attachment();
        $dataProvider = $model->search();
        $dataProvider->pagination->defaultPageSize = 25;

        return $this->render('manager', [
            'model' => $model,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionUploadmanager()
    {
        $this->layout = '@vendor/pendalf89/yii2-filemanager/views/layouts/main';

        return $this->render('uploadmanager', [
            'model' => new Attachment(),
        ]);
    }

    /**
     * Provides upload file
     * @return mixed
     */
    public function actionUpload()
    {
        $model = new Attachment();

        $model->saveUploadedFile();

        $bundle = FilemanagerAsset::register($this->view);

//        if ($model->isImage() && $this->module->thumbs) {
//            $model->createThumbs($routes, $this->module->thumbs);
//        }

        Yii::$app->response->format = Response::FORMAT_JSON;

        return [
            'files' => [
                [
                    'path' => $model->path,
//                    'thumbnailUrl' => 'http://www.sailshop.com/' . $model->getDefaultThumbUrl($bundle->baseUrl),
//                    'thumbnailUrl' => 'http://www.sailshop.com/' . $model->path,
                    'thumbnailUrl' => $this->module->routes['baseUrl'] . $model->path,
                    'name' => $model->filename,
                    'size' => $model->file->size,
                    'deleteUrl' => Url::to(['file/delete', 'id' => $model->id]),
                    'deleteType' => 'POST',
                ],
            ],
        ];

//        $response['files'][] = [
//            'url'           => $model->url,
//            'thumbnailUrl'  => $model->getDefaultThumbUrl($bundle->baseUrl),
//            'name'          => $model->filename,
//            'type'          => $model->type,
//            'size'          => $model->file->size,
//            'deleteUrl'     => Url::to(['file/delete', 'id' => $model->id]),
//            'deleteType'    => 'POST',
//        ];
//
//        return $response;
    }

    /**
     * Updated mediafile by id
     * @param $id
     * @return array
     */
    public function actionUpdate($id)
    {
        $model = Mediafile::findOne($id);
        $message = Module::t('main', 'Changes not saved.');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $message = Module::t('main', 'Changes saved!');
        }

        Yii::$app->session->setFlash('mediafileUpdateResult', $message);

        return $this->renderPartial('info', [
            'model' => $model,
            'strictThumb' => null,
        ]);
    }

    /**
     * Delete model with files
     * @param $id
     * @return array
     */
    public function actionDelete($id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
//        $routes = $this->module->routes;

        if ($model = Attachment::findOne($id)) {
            $model->delete();
        }

//        if ($model->isImage()) {
//            $model->deleteThumbs($routes);
//        }
//
        $model->deleteFile();

        return ['success' => 'true'];
    }

    /**
     * Resize all thumbnails
     */
    public function actionResize()
    {
        $models = Mediafile::findByTypes(Mediafile::$imageFileTypes);
        $routes = $this->module->routes;

        foreach ($models as $model) {
            if ($model->isImage()) {
                $model->deleteThumbs($routes);
                $model->createThumbs($routes, $this->module->thumbs);
            }
        }

        Yii::$app->session->setFlash('successResize');
        $this->redirect(Url::to(['default/settings']));
    }

    /** Render model info
     * @param int $id
     * @param string $strictThumb only this thumb will be selected
     * @return string
     */
    public function actionInfo($id, $strictThumb = null)
    {
        $model = Attachment::findOne($id);

        return $this->renderPartial('info', [
            'model' => $model,
            'strictThumb' => $strictThumb,
        ]);
    }
}

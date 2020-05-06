<?php

namespace backend\controllers\system;

use backend\models\system\AuthMenu;
use backend\models\system\MenuPermission;
use backend\models\system\RoleMenuPermission;
use Yii;
use backend\models\system\Role;
use backend\models\system\RoleSearch;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\widgets\Menu;

/**
 * RoleController implements the CRUD actions for Role model.
 */
class RoleController extends Controller
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
     * Lists all Role models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RoleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Role model.
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
     * Creates a new Role model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Role();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', '角色创建成功');
            return $this->redirect('index');
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Role model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            RoleMenuPermission::flushPermission($model->id, Yii::$app->request->post('permissionIds'));

            Yii::$app->session->setFlash('success', '角色更新成功');
            return $this->redirect('index');
        } else {
            $menus = $this->combine($this->findMenus(), $this->findMenuPermissions());
            $permissions = $model->getMenuPermissions()
                ->indexBy('permission_id')
                ->asArray()
                ->all();

            return $this->render('update', [
                'model' => $model,
                'menus' => ArrayHelper::toTreeStructure($menus),
                'permissions' => $permissions,
            ]);
        }
    }

    /**
     * Deletes an existing Role model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        Yii::$app->session->setFlash('success', '角色删除成功');
        return $this->redirect(['index']);
    }

    /**
     * Finds the Role model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Role the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Role::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * @return array
     */
    protected function findMenus()
    {
        return AuthMenu::find()
            ->asArray()
            ->indexBy('id')
            ->all();
    }

    /**
     * @return array
     */
    protected function findMenuPermissions()
    {
        return MenuPermission::find()
            ->asArray()
            ->all();
    }

    /**
     * @param array $menus
     * @param array $permissions
     * @return array
     */
    protected function combine($menus, $permissions)
    {
        foreach ($permissions as $permission) {
            $menus[$permission['menu_id']]['permissions'][] = $permission;
        }
        return $menus;
    }
}

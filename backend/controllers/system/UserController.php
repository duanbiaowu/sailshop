<?php

namespace backend\controllers\system;

use backend\models\system\AuthRole;
use backend\models\system\Role;
use backend\models\system\UserRole;
use Yii;
use backend\models\system\User;
use backend\models\system\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
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
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'roles' => Role::find()->indexBy('id')->all(),
        ]);
    }

    /**
     * Displays a single User model.
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
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new User();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', '用户创建成功');
            return $this->redirect('index');
        } else {
            return $this->render('create', [
                'model' => $model,
                'roles' => AuthRole::getAuthRoles(),
            ]);
        }
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->setScenario('update');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', '用户更新成功');
            return $this->redirect('index');
        } else {
            return $this->render('update', [
                'model' => $model,
                'roles' => AuthRole::getAuthRoles(),
            ]);
        }
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->status = User::STATUS_DELETED;
        $model->save();

        Yii::$app->session->setFlash('success', '用户删除成功');
        return $this->redirect(['index']);
    }

    /**
     * 修改用户角色
     * @param integer $id
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionRole($id)
    {
        $model = $this->findModel($id);

        if (Yii::$app->request->isPost) {
            UserRole::deleteAll(['user_id' => $model->id]);

            $roleIds = (array)Yii::$app->request->post('roleIds');
            foreach ($roleIds as $roleId) {
                $userRole = new UserRole();
                $userRole->user_id = $model->id;
                $userRole->role_id = (int)$roleId;
                $userRole->save();
            }

            Yii::$app->session->setFlash('success', '用户角色更新成功');
            return $this->redirect('index');
        }

        $userRoles = $model->getRoles()
            ->indexBy('role_id')
            ->all();

        return $this->render('_role', [
            'model' => $model,
            'roles' => Role::find()->all(),
            'userRoles' => $userRoles,
        ]);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

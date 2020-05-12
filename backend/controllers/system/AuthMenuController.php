<?php

namespace backend\controllers\system;

use backend\models\system\MenuPermission;
use Yii;
use backend\models\system\AuthMenu;
use backend\models\system\AuthMenuSearch;
use yii\helpers\ArrayHelper;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AuthMenuController implements the CRUD actions for AuthMenu model.
 */
class AuthMenuController extends Controller
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
     * Lists all AuthMenu models.
     * @return mixed
     */
    public function actionIndex()
    {
        $menus = AuthMenu::getAllMenus();

        return $this->render('index', [
            'categories' => ArrayHelper::toTreeStructure($menus),
        ]);
    }

    /**
     * Displays a single AuthMenu model.
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
     * Creates a new AuthMenu model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AuthMenu();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', '菜单创建成功');
            return $this->redirect('index');
        } else {
            return $this->render('create', [
                'model' => $model,
                'categories' => $model->categories(),
            ]);
        }
    }

    /**
     * Updates an existing AuthMenu model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', '菜单更新成功');
            return $this->redirect('index');
        } else {
            return $this->render('update', [
                'model' => $model,
                'categories' => $model->categories(),
            ]);
        }
    }

    /**
     * Deletes an existing AuthMenu model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        Yii::$app->session->setFlash('success', '菜单删除成功');

        return $this->redirect(['index']);
    }

    /**
     * 修改角色权限
     * @param int $id
     * @return string|\yii\web\Response
     * @throws BadRequestHttpException
     * @throws NotFoundHttpException
     * @throws \yii\db\StaleObjectException
     */
    public function actionPermission($id)
    {
        $model = $this->findModel($id);
        $permissions = $model->getPermissions()
            ->all();

        if ($data = Yii::$app->request->post()) {
            if (isset($data['name']) && is_array($data['name'])) {

                foreach (array_filter($data['name']) as $index => $name) {
//                    if (!isset($data['method'][$index]) || !$data['method'][$index]) {
//                        continue;
//                    }
                    $query = isset($data['query'][$index]) ? $data['query'][$index] : null;
                    $method = isset($data['method'][$index]) ? $data['method'][$index] : null;

                    if (isset($permissions[$index]) && $permissions[$index]) {
                        $permission = $permissions[$index];
                    } else {
                        $permission = new MenuPermission();
                    }
                    $permission->setAttributes([
                        'menu_id' => $model->id,
                        'name' => $name,
                        'method' => $data['method'][$index],
                        'query' => $query
                    ]);
                    $permission->save();
                }
                $start = count($data['name']);
            } else {
                $start = 0;
            }

            for ($end = count($permissions); $start < $end; ++$start) {
                $permission = $permissions[$start];
                $permission->delete();
            }

            Yii::$app->session->setFlash('success', '菜单权限更新成功');
            return $this->redirect('index');
        }

        $formatPermissions = [];
        foreach ($permissions as $permission) {
            $formatPermissions[] = $permission->getAttributes();
        }

        return $this->render('_permission', [
            'model' => $model,
            'permissions' => $formatPermissions,
        ]);
    }

    /**
     * Finds the AuthMenu model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AuthMenu the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AuthMenu::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

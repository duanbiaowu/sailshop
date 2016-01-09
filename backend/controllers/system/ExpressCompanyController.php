<?php
/**
 * @name: SailShop System
 * @author: 游梦惊园
 * @link: https://github.com/duanbiaowu/sailshop
 * @blog: http://www.cnblogs.com/duanbiaowu
 * @copyright: Copyright (c) 2016 SailShop System
 * @date: 2015-11-06
 */

namespace backend\controllers\system;

use Yii;
use yii\web\Controller;
use backend\models\system\ExpressCompany;
use backend\models\system\ExpressCompanySearch;

class ExpressCompanyController extends Controller
{
    public function actionIndex()
    {
        $searchModel = new ExpressCompanySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('/system/pay/express', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCreate()
    {
        $model = new ExpressCompany();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect('index');
        } else {
            return $this->render('/system/pay/create', [
                'model' => $model,
            ]);
        }
    }
}
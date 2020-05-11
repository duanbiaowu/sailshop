<?php

namespace backend\controllers\order;

use backend\models\system\ExpressCompany;
use common\models\system\PaymentType;
use Yii;
use common\models\order\Order;
use common\models\order\OrderSearch;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * OrderController implements the CRUD actions for Order model.
 */
class OrderController extends Controller
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
     * Lists all Order models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new OrderSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'status' => Order::formatStatus(),
            'paymentTypes' => ArrayHelper::map(PaymentType::find()->asArray()->all(), 'id', 'name'),
        ]);
    }

    public function actionView($id)
    {
        $model = $this->findModel($id);
        $details = $model->getOrderDetails()
            ->all();
        $bookTotalPrice = 0;
        foreach ($details as $detail) {
            $bookTotalPrice += $detail->price * $detail->number;
        }

        return $this->render('view', [
            'model' => $model,
            'details' => $details,
            'bookTotalPrice' => sprintf('%.2f', $bookTotalPrice),
            'freightPrice' => sprintf('%.2f', $model->price_count - $bookTotalPrice),
            'paymentType' => PaymentType::findOne($model->pay_type),
            'expressCompany' => ExpressCompany::findOne($model->express_type),
            'status' => Order::formatStatus(),
        ]);
    }

    public function actionCreate()
    {
        $model = new Order();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', '订单信息更新成功');
            return $this->redirect('index');
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        Yii::$app->session->setFlash('success', '订单信息删除成功');

        return $this->redirect(['index']);
    }

    public function actionDelivery($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->status = Order::DELIVERED_STATUS;
            if ($model->save()) {
                Yii::$app->session->setFlash('success', '订单信息更新成功');
            } else {
                Yii::$app->session->setFlash('danger', '网络延迟，请稍后重试');
            }
            return $this->redirect(urldecode(Yii::$app->getRequest()->getBodyParam('redirect')));
        } else {
            return $this->renderPartial('_delivery', [
                'model' => $model,
                'redirect' => Yii::$app->getRequest()->getQueryParam('redirect')
            ]);
        }
    }

    protected function findModel($id)
    {
        if (($model = Order::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

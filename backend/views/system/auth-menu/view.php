<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\system\AuthMenu */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('System', 'Auth Menus'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="auth-menu-view">
    <p>
        <?= Html::a(Yii::t('System', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('System', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('System', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            [
                'attribute' => 'parent_id',
                'format' => 'raw',
                'value' => call_user_func(function($model) {
                    $result = '';
                    foreach ($model->getParentMenu() as $index => $menu) {
                        $result .= str_repeat('&nbsp;', $index * 8) . '<span class="glyphicon glyphicon-th-list"></span> ' . $menu . '<br/>';
                    }
                    return $result;
                }, $model)
            ],
            [
                'attribute' => 'route',
                'format' => 'raw',
                'value' => Html::a($model->route, Url::toRoute($model->route), ['target' => '_blank']),
            ],
        ],
    ]) ?>

</div>

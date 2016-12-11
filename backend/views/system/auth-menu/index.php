<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\system\AuthMenuSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $categories */

$this->title = Yii::t('System', 'Auth Menus');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="auth-menu-index">

    <p>
        <?= Html::a(Yii::t('System', 'Create Auth Menu'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <table class="table table-bordered">
        <thead>
        <tr>
            <th width="50%"><?= Yii::t('System', 'Menu Name'); ?></th>
            <th width="30%"><?= Yii::t('System', 'Menu Route'); ?></th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($categories as $index => $category): ?>
        <tr>
            <td class="js-category-top">
                <span class="glyphicon glyphicon-th-list"></span> <?= $category['name'] ?>
                <?php if ($category['children']): ?>
                <span class="glyphicon glyphicon-hand-up pull-right"></span>
                <?php endif; ?>
            </td>

            <td><?= Html::a($category['route'], Url::toRoute($category['route']), ['target' => '_blank']) ?></td>
            <td>
                <?= Html::a(Yii::t('System', 'View'), Url::toRoute(['/system/auth-menu/view', 'id' => $category['id']]), ['class' => 'btn btn-success btn-sm']) ?>
                <?= Html::a(Yii::t('System', 'Update'), Url::toRoute(['/system/auth-menu/update', 'id' => $category['id']]), ['class' => 'btn btn-primary btn-sm']) ?>
                <?= Html::a(Yii::t('System', 'Delete'), Url::toRoute(['/system/auth-menu/delete', 'id' => $category['id']]), [
                    'class' => 'btn btn-danger btn-sm',
                    'data' => [
                        'confirm' => Yii::t('System', 'common_delete_confirm'),
                        'method' => 'post',
                    ],
                ]) ?>
            </td>
        </tr>

            <?php foreach ($category['children'] as $child): ?>
            <tr style="display: none;" class="js-category-index-<?= $index ?>">
                <td>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <span class="glyphicon glyphicon-th-list"></span> <?= $child['name'] ?>
                </td>
                <td><?= Html::a($child['route'], Url::toRoute($child['route']), ['target' => '_blank']) ?></td>
                <td>
                    <?= Html::a(Yii::t('System', 'View'), Url::toRoute(['/system/auth-menu/view', 'id' => $child['id']]), ['class' => 'btn btn-success btn-sm']) ?>
                    <?= Html::a(Yii::t('System', 'Update'), Url::toRoute(['/system/auth-menu/update', 'id' => $child['id']]), ['class' => 'btn btn-primary btn-sm']) ?>
                    <?= Html::a(Yii::t('System', 'Delete'), Url::toRoute(['/system/auth-menu/delete', 'id' => $child['id']]), [
                        'class' => 'btn btn-danger btn-sm',
                        'data' => [
                        'confirm' => Yii::t('System', 'common_delete_confirm'),
                        'method' => 'post',
                    ],
                    ]) ?>
                </td>
            </tr>


                <?php foreach ($child['children'] as $value): ?>
                    <tr style="display: none;" class="js-category-index-<?= $index ?>">
                        <td>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <span class="glyphicon glyphicon-th-list"></span> <?= $value['name'] ?>
                        </td>
                        <td><?= Html::a($value['route'], Url::toRoute($value['route']), ['target' => '_blank']) ?></td>
                        <td>
                            <?= Html::a(Yii::t('System', 'View'), Url::toRoute(['/system/auth-menu/view', 'id' => $value['id']]), ['class' => 'btn btn-success btn-sm']) ?>
                            <?= Html::a(Yii::t('System', 'Update'), Url::toRoute(['/system/auth-menu/update', 'id' => $value['id']]), ['class' => 'btn btn-primary btn-sm']) ?>
                            <?= Html::a(Yii::t('System', 'Delete'), Url::toRoute(['/system/auth-menu/delete', 'id' => $value['id']]), [
                                'class' => 'btn btn-danger btn-sm',
                                'data' => [
                                    'confirm' => Yii::t('System', 'common_delete_confirm'),
                                    'method' => 'post',
                                ],
                            ]) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>

            <?php endforeach; ?>

        <?php endforeach; ?>
        </tbody>
    </table>
</div>


<?php $this->registerJs(
    <<<EOF
    $('.js-category-top').on('click', function() {
        var index = $('.js-category-top').index($(this));
        $('.js-category-index-' + index).toggle();
    });
EOF
) ?>
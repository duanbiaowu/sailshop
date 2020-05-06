<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\models\content\ArticleCategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var array $categories */

$this->title = '文章分类';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-category-index">

    <p>
        <?= Html::a('创建文章分类', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <table class="table table-bordered">
        <thead>
        <tr>
            <th width="50%">分类名称</th>
            <th width="25%">排序值</th>
            <th class="text-center">操作</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($categories as $index => $category): ?>
        <tr>
            <td class="js-category-top">
                <?= str_repeat('──', $category['depth'] * 2) ?>
                <?= $category['name'] ?>
            </td>

            <td><?= $category['sort'] ?></td>
            <td class="text-center">
                <?= Html::a(Yii::t('System', 'Update'), Url::toRoute(['/content/article-category/update', 'id' => $category['id']]), ['class' => 'btn btn-primary btn-sm']) ?>
                <?= Html::a(Yii::t('System', 'Delete'), Url::toRoute(['/content/article-category/delete', 'id' => $category['id']]), [
                    'class' => 'btn btn-danger btn-sm',
                    'data' => [
                        'confirm' => Yii::t('System', 'common_delete_confirm'),
                        'method' => 'post',
                    ],
                ]) ?>
            </td>
        </tr>

        <?php endforeach; ?>

        </tbody>
    </table>
</div>

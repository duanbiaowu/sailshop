<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\content\ArticleCategory */

$this->title = 'Create Article Category';
$this->params['breadcrumbs'][] = ['label' => 'Article Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-category-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

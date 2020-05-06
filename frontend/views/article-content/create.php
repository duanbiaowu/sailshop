<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\content\ArticleContent */

$this->title = 'Create Article Content';
$this->params['breadcrumbs'][] = ['label' => 'Article Contents', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-content-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

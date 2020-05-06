<?php

use common\models\content\ArticleCategory;
use common\models\content\ArticleContent;
use common\models\content\ArticleContentSearch;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\content\ArticleContent */
/* @var ArticleContent $model */
/* @var array $articleCategories */
/* @var array $articles */

$articleCategories = ArticleCategory::find()->where(['parent_id' => 0])->indexBy('id')->asArray()->all();
$articles = ArticleContentSearch::find()->asArray()->select(['id', 'title', 'category_id'])->all();
foreach ($articles as $article) {
    $articleCategories[$article['category_id']]['articles'][] = $article;
}

?>

<link type="text/css" rel="stylesheet" href="/themes/default/css/ucenter.css">
<!-- S 面包屑导航 -->
<div class="bread-crumb">
    <ol class="container">
        <li><a href="/">首页</a></li>
        <li><a href="/index.php?con=index&amp;act=help_index">帮助中心 </a></li>
    </ol>
</div>

<!-- E 面包屑导航 -->
<div class="container list">
    <div class="row-5">
        <div class="col-1 side-menu">
            <h2 class="header">帮助中心</h2>
            <div>
                <?php foreach ($articleCategories as $index => $articleCategory): ?>
                <div class="sub-menu">
                    <h2 class="header"><?= $articleCategory['name'] ?></h2>
                    <ul>
                        <?php foreach ($articleCategory['articles'] as $article): ?>
                        <li class="menu-item"><a href="/article-content/view?id=<?= $article['id'] ?>"><?= $article['title'] ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="col-4">
            <div class="content-text">
                <h1 class="title"><span>售后保障</span></h1>
                <div style="padding-left: 20px;">
                    <pre>
                    <?= str_replace('', '', $model->content) ?>
                    </pre>
                </div>
            </div>
        </div>
    </div>
</div>


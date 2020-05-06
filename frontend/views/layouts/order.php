<?php
/**
 * @link: http://www.h2o-china.com
 * @Copyright (c) 2017 E20-Framework
 * @author Biaowu Duan <codean.net@gmail.com>
 * @version 1.0
 */

/* @var $this \yii\web\View */

/* @var $content string */


use common\models\content\ArticleCategory;
use common\models\content\ArticleContentSearch;
use common\models\goods\Brand;
use common\models\goods\Category;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= Yii::$app->params['siteBaseInfo']['siteName'] ?></title>
    <meta name="keywords" content="<?= Yii::$app->params['siteBaseInfo']['keyword'] ?>">
    <meta name="description" content="<?= Yii::$app->params['siteBaseInfo']['description'] ?>">
    <link rel="shortcut icon" href="/favicon.ico"/>
    <link rel="bookmark" href="/favicon.ico"/>
    <link rel="stylesheet" href="/themes/default/css/common.css">
    <link rel="stylesheet" href="/themes/default/vendors/awesome/css/font-awesome.min.css">
    <style type="text/css">
        .js-template {
            display: none !important;
        }
    </style>
    <script type="text/javascript" src="/themes/default/vendors/jquery.min.js"></script>
    <script type="text/javascript" src="/themes/default/js/common.min.js"></script>
    <script type="text/javascript" src="/themes/default/vendors/layer/layer.js"></script>
    <script type="text/javascript">
        var server_url = '/__con__/__act__';
        var Tiny = {user: {name: 'duanbiaowu', id: '2', online: true}};
    </script>
</head>

<body>
<!-- S 页头部分 -->
<div id="header">
    <div class="fixed-top-nav">
        <div id="fixed-wrap">
            <div class="container">
                <div class="header-main">
                    <div class="sub-1">
                        <a href="/">
                        <img src="/images/logo.png" style="width: 224px;" />
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- E 页头部分 -->
<!-- S 主体部分 -->
<div id="main">
    <?= $content ?>
</div>
<!-- E 主体部分 -->
<!-- S 页脚部分 -->
<div id="footer">
    <div class="container" style="margin-top: 50px;">
        <div class="footer-bottom">
            <?= Yii::$app->params['siteBaseInfo']['address'] ?>
            <?= Yii::$app->params['siteBaseInfo']['siteUrl'] ?>
            <?= Yii::$app->params['siteBaseInfo']['siteIcp'] ?>
        </div>
    </div>
</div>
<!-- E 页脚部分 -->


</body>
</html>

<!- Powered by TinyRise ->

<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

AppAsset::register($this);
?>

<?php $this->beginPage() ?>

<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?> - <?= Yii::$app->params['siteBaseInfo']['siteName'] ?></title>
    <?php $this->head() ?>
</head>
<body>

<?php $this->beginBody() ?>

<div class="wrap">
<?php
    NavBar::begin([
        'brandLabel' => '扬帆书店管理后台',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-static-top',
        ],
        'innerContainerOptions' => [
            'class' => 'container-fluid'
        ],
    ]);
    $menuItems = [];

    if (!Yii::$app->user->isGuest) {
        $navItems = [];
        foreach (Yii::$app->params['menus']['values'] as $index => $nav) {
            $navItems[] = [
                'label' => $nav['name'],
                'url' => $nav['route'],
                'options' => Yii::$app->params['menus']['index'] == $index ? ['class' => 'active'] : [],
            ];
        }
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav navbar-left'],
            'items' => $navItems,
        ]);
    }

    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => '管理员登录', 'url' => ['/site/login']];
    } else {
        $menuItems[] = '<li><a href="javascript:;"><span class="badge progress-bar-success">' . date('Y-m-d', time()) . '</span></a></li>';
        $menuItems[] = [
            'label' => Yii::$app->user->identity->nickname,
            'items' => [
//                '<li><a href="/user/center" tabindex="-1"><span class="glyphicon glyphicon-user"></span> 个人中心</a></li>',
//                '<li class="divider"></li>',
//                '<li><a href="/user/site" tabindex="-1"><span class="glyphicon glyphicon-cog"></span> 帐号设置</a></li>',
//                '<li class="divider"></li>',
                '<li><a href="/site/logout" data-method="post" tabindex="-1"><span class="glyphicon glyphicon-log-out"></span> 退出系统</a></li>',
            ]
        ];
    }

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);

    NavBar::end();
?>

    <div class="container-fluid">
        <div class="row">
            <?php if (!Yii::$app->user->isGuest) { ?>
                <div class="col-xs-12 col-sm-3 col-md-3 col-lg-2">
                    <?php foreach (Yii::$app->params['menus']['values'][Yii::$app->params['menus']['index']]['children'] as $menu):?>

                        <div class="list-group">
                            <a href="#" class="list-group-item disabled">
                                <h4 class="panel-title"><?= $menu['name'] ?></h4>
                            </a>
                            <?php foreach ($menu['children'] as $child): ?>

                            <a href="<?= Url::toRoute($child['route']) ?>" class="list-group-item <?php if (('/' . Yii::$app->controller->id == $child['route']) || ('/' . Yii::$app->request->pathInfo == $child['route'])) echo 'active'; ?>">
                                <?= $child['name'] ?>
                            </a>

                            <?php endforeach; ?>
                        </div>

                    <?php endforeach; ?>
                </div>
            <?php } ?>

            <div class="col-xs-12 col-sm-9 col-md-9 col-lg-10">
                <?= Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ]) ?>
                <?= Alert::widget() ?>
                <?= $content ?>
            </div>
        </div>
    </div>
</div>

<footer class="footer">
    <div class="container-fluid">
        <p class="pull-left">&copy; 扬帆书店管理后台 2019 - 2099</p>
        <p class="pull-right">京ICP备0123456号-7</p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

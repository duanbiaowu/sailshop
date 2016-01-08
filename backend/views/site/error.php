<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Url;

$this->title = '页面找不到啦！';

?>
<div class="form-group">

    <div class="jumbotron text-left">
        <h1 class="text-info">404</h1>

        <h4>你访问的页面找不到了！</h4>

        网络正常，您所访问的页面资源不存在(404)，
        <a href="<?= Url::toRoute('system/system/index') ?>">返回系统首页</a>

    </div>

</div>
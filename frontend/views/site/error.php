<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
?>

<div class="container list blank">
    <div class="col-sm-12">
        <div class="col-sm-4"></div>
        <div class="col-sm-6">
            <h1 class="text-danger" style="font-size: 24px;"><?= $exception->getMessage() ?></h1>
            <ul>
                <li>1. 请检查您输入的网址是否正确。</li>
                <li>2. 确认无误有可能我们的页面正在升级或维护。</li>
                <li>3. 您可以尝试稍后访问。</li>
            </ul>
        </div>
    </div>
</div>

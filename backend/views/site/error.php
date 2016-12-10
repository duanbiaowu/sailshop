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
        <h1 class="text-info"><?= $exception->getCode() | 404 ?></h1>

        <h4><?= Yii::t('System', $message) ?></h4>

        <a href="<?= Url::toRoute('/system/index') ?>"><?= Yii::t('System', 'Back Home') ?></a>

    </div>

</div>
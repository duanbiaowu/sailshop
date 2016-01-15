<?php

use yii\helpers\Html;

//var_dump();Yii::$app->end();
?>

<div class="form-group">
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" <?php if (Yii::$app->controller->action->id == 'site') echo 'class="active"'; ?>>
            <?= Html::a('基本信息', '/system/system') ?>
        </li>
        <li role="presentation" <?php if (Yii::$app->controller->action->id == 'other') echo 'class="active"'; ?>>
            <?= Html::a('其它信息', '/system/system/other') ?>
        </li>
        <li role="presentation" <?php if (Yii::$app->controller->action->id == 'email') echo 'class="active"'; ?>>
            <?= Html::a('邮箱信息', '/system/system/email') ?>
        </li>
    </ul>
</div>



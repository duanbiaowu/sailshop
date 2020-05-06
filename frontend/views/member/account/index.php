<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $model \frontend\models\PasswordResetRequestForm */
/* @var string $testToken */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\web\View;

?>

<link type="text/css" rel="stylesheet" href="/themes/default/css/ucenter.css">

<div class="container list blank">
    <div class="row-5">
        <?= $this->render('../_menu') ?>

        <div class="col-4">
            <h1 class="title"><span>安全中心</span></h1>
            <table class="table table-list big">
                <tbody><tr class="even">
                    <td class="caption"><i class="verified"></i>登录密码</td>
                    <td>互联网账号存在被盗风险，建议您定期更改密码以保护账户安全。</td>
                    <td width="120"><a href="reset">修改</a></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
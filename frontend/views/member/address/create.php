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
            <h1 class="title"><span>收货地址：</span></h1>
            <div class="blank fr"><a id="address_other" class="btn btn-main" href="javascript:;">添加新地址</a></div>
            <table class="table table-list address-list">
                <tr>
                    <th>收货人</th>
                    <th>所在地区</th>
                    <th>街道地址</th>
                    <th>邮编</th>
                    <th>电话/手机</th>
                    <th></th>
                    <th>操作</th>
                </tr>
                {list:items=$address}
                <tr class="{if:$key%2==1}odd{else:}even{/if}">
                    <td>{$item['accept_name']}</td>
                    <td>{$parse_area[$item['province']]},{$parse_area[$item['city']]},{$parse_area[$item['county']]}
                    </td>
                    <td>{$item['addr']}</td>
                    <td>{$item['zip']}</td>
                    <td>{$item['mobile']}/{$item['phone']}</td>
                    <td>{if:$item['is_default']==1}<b>默认地址</b>{/if}</td>
                    <td><a href="javascript:;" data-value="{$item['id']}" class="modify">修改</a> | <a
                                href="javascript:confirm_action('{url:/ucenter/address_del/id/$item[id]}')">删除</a></td>
                </tr>
                {/list}
            </table>
            <div class="mt10">最多可保存20个有效地址！</div>
        </div>
    </div>
</div>

<script type="text/javascript">

    $("#address_other").on("click", function () {
        //art.dialog.open('{url:/simple/address_other}',{width:960,height:462,lock:true});
        layer.open({
            type: 2,
            title: '添加收货地址',
            shadeClose: true,
            shade: 0.8,
            area: ['960px', '580px'],
            content: '{url:/simple/address_other}'
        });
        return false;
    })

    $(".address-list .modify").each(function () {
        $(this).on("click", function () {
            var id = $(this).attr("data-value");
            //art.dialog.open(,{width:960,height:462,lock:true});
            layer.open({
                type: 2,
                title: '添加收货地址',
                shadeClose: true,
                shade: 0.8,
                area: ['960px', '580px'],
                content: '{url:/simple/address_other/id/}' + id
            });
        });
    });
</script>

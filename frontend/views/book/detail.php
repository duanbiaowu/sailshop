<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $model \frontend\models\PasswordResetRequestForm */
/* @var MemberAccountRecord[] $records */
/* @var Pagination $pagination */
/* @var array $typeLabels */

use common\models\MemberAccountRecord;
use yii\data\Pagination;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\web\View;
use frontend\widgets\LinkPager;

?>

<link type="text/css" rel="stylesheet" href="/themes/default/css/ucenter.css">
<link type="text/css" rel="stylesheet" href="/themes/default/systemjs/form/style.css">
<script type="text/javascript" charset="UTF-8" src="/themes/default/systemjs/form/form.js"></script>

<div class="container list blank">
    <div class="row-5">
        <?= $this->render('../_menu') ?>

        <div class="col-4">
            <?php if (Yii::$app->session->hasFlash('success')): ?>
                <div id="field-info" class="alert alert-success" role="alert" style="width: 335px;">
                    <?= Yii::$app->session->getFlash('success') ?>
                </div>
            <?php endif; ?>

            <?php if (Yii::$app->session->hasFlash('danger')): ?>
                <div id="field-info" class="alert alert-danger" role="alert" style="width: 335px;">
                    <?= Yii::$app->session->getFlash('danger') ?>
                </div>
            <?php endif; ?>

            <h1 class="title"><span>账户金额管理</span></h1>
            <div class="box">账户余额：
                <b class="">￥<?= Yii::$app->user->getIdentity()->account ?></b>
                <span class="fr">
                    <a href="javascript:;" id="recharge-btn" class="btn btn-main btn-mini">充值</a>
                </span>
            </div>
            <div class="mt10 tab" index="0">
                <ul class="tab-head">
                    <li class="current">交易记录<i></i></li>
                </ul>
                <div class="tab-body">
                    <div style="display: block;">
                        <table class="table table-list">
                            <tbody>
                            <tr>
                                <th width="260">时间</th>
                                <th width="120">充值 / 消费</th>
                                <th width="120">金额</th>
                                <th>备注</th>
                            </tr>
                            <?php foreach ($records as $record): ?>
                            <tr>
                                <td width="260" style="text-align: center;"><?= $record->create_time ?></td>
                                <td width="120" style="text-align: center;">
                                    <?= $typeLabels[$record->type] ?>
                                </td>
                                <td width="120" style="text-align: center;"><?= $record->value ?></td>
                                <td style="text-align: center;"><?= $record->remark ?></td>
                            </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                        <?php echo LinkPager::widget([
                            'pagination' => $pagination,
                            'nextPageLabel' => '下一页',
                            'prevPageLabel' => '上一页',
//                            'firstPageLabel' => '首页',
//                            'lastPageLabel' => '尾页',
                            'options' => ['class' => 'page-nav'],
                        ]); ?>
                        <div class="page-nav" style="display: none;"><span href="/index.php?con=ucenter&amp;act=account&amp;p=1" class="disabled">上一页</span>  <span href="/index.php?con=ucenter&amp;act=account&amp;p=2" class="disabled">下一页</span> &nbsp;&nbsp;&nbsp;&nbsp;共0 页&nbsp;&nbsp;&nbsp;&nbsp;跳到第 <input id="page_input_489f692dd08094b1e208eb550584262e" style="width:24px;text-align:center" value="1"> 页 <a href="javascript:;" onclick="javascript:window.location.href=&quot;/index.php?con=ucenter&amp;act=account&amp;p=&quot;+document.getElementById(&quot;page_input_489f692dd08094b1e208eb550584262e&quot;).value;">确定</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="recharge-dialog" style="display:none"  >
    <form action="create"  method="post" formMsg="recharge-info" callback="close_dialog">
        <?= Html::hiddenInput(Yii::$app->request->csrfParam, Yii::$app->request->csrfToken) ?>
        <ul class="tiny-form hidden-msg" style="padding:20px 20px 0 20px;">
            <li class="line" style="height:20px;">
                <div id="recharge-info" class="alert alert-fail" style="display:none;"></div>
            </li>
            <li class="line caption">
                <label class="caption">充值金额：</label>
                <input class="field" type="text" name="value"  pattern="float" alt="最小金额不小于0.01"> <label></label>
            </li>
            <li class="line other">
                <label class="caption">支付方式：</label>
                <select class="field" name="remark">
                    <option value="支付宝">支付宝[即时到帐]</option>
                    <option value="微信">微信[即时到帐]</option>
                </select>
            </li>
            <li class="line tc">
                <input type="submit" class="btn btn-main" value="立刻充值">
            </li>
        </ul>
    </form>
</div>

<script type="text/javascript">
    $("#recharge-btn").on("click",function() {
        layer.open({
            id:'rechargeDialog',
            type: 1,
            title: '充值[演示效果专用]',
            move: false,
            shade: 0.6,
            area: ['460px', '300px'],
            content: $('#recharge-dialog') //iframe的url
        });
    });
    $("#withdraw-btn").on("click",function() {
        layer.open({
            id:'withdrawDialog',
            type: 1,
            title: '充值',
            move: false,
            shade: 0.6,
            area: ['520px', '500px'],
            content: $('#withdraw-dialog') //iframe的url
        });
    });
    function close_dialog(e){
        if(!e)layer.closeAll();
    }
    function submit_withdraw(e){
        if(!e){
            var name = $("#w_name").val();
            var type_name = $("#w_type_name").val();
            var account = $("#w_account").val();
            var amount = $("#w_amount").val();
            $.get("{url:/ucenter/withdraw}",{name:name,type_name:type_name,account:account,amount:amount},function(data){
                if(data['status']=='success'){
                    layer.closeAll();
                    window.location.href = "{url:/ucenter/account/rand/}"+Math.random()+"#tab-1";
                }else{
                    layer.msg(data['msg']);
                }
            },'json');
        }
        return false;
    }

    console.log(  );
</script>
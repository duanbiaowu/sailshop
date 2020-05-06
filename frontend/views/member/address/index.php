<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var MemberShippingAddress[] $addresses */

use common\models\MemberShippingAddress;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\web\View;

?>

<link type="text/css" rel="stylesheet" href="/themes/default/css/ucenter.css">

<div class="container list blank">
    <div class="row-5">
        <?= $this->render('../_menu') ?>

        <div class="col-4">
            <h1 class="title"><span>收货地址</span></h1>
            <div class="blank fr"><a id="address_other" class="btn btn-main" href="javascript:;">添加新地址</a></div>
            <table class="table table-list address-list" style="text-align: left;">
                <tr>
                    <th>收货人</th>
                    <th>所在地区</th>
                    <th>街道地址</th>
                    <th>邮编</th>
                    <th>手机</th>
                    <th></th>
                    <th>操作</th>
                </tr>

                <?php foreach ($addresses as $index => $address): ?>
                    <tr class="<?php if ($index % 2): ?>>odd<?php else: ?>even<?php endif ?>">
                        <td><?= $address['name'] ?></td>
                        <td><?= $address['province_name'] ?> - <?= $address['city_name'] ?>
                            - <?= $address['district_name'] ?></td>
                        <td><?= $address['detail_address'] ?></td>
                        <td><?= $address['remark'] ?></td>
                        <td><?= $address['mobile'] ?></td>
                        <td><?php if ($address->is_default): ?><b>默认地址</b><?php endif; ?></td>
                        <td>
                            <a href="javascript:;" data-value="<?= $address->id ?>" class="modify">修改</a> |
                            <a href="javascript:;" class="js-address-delete" data-id="<?= $address->id ?>">删除</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
</div>

<script type="text/javascript">

    $("#address_other").on("click", function () {
        layer.open({
            type: 2,
            title: '添加收货地址',
            shadeClose: true,
            shade: 0.8,
            area: ['960px', '580px'],
            content: 'create',
            cancel: function (index, layero) {
                parent.location.reload();
            }
        });
        return false;
    })

    $(".address-list .modify").each(function () {
        $(this).on("click", function () {
            var id = $(this).attr("data-value");
            layer.open({
                type: 2,
                title: '修改收货地址',
                shadeClose: true,
                shade: 0.8,
                area: ['960px', '580px'],
                content: 'update?id=' + id,
                cancel: function (index, layero) {
                    parent.location.reload();
                }
            });
        });
    });

    $('.js-address-delete').on('click', function () {
        var id = $(this).data('id');
        var data = {
            _csrf: '<?= Yii::$app->request->csrfToken ?>',
        };
        layer.confirm('确认删除这条数据吗？此操作不可恢复！', {icon: 3, title: '提示'}, function (index) {
            $.post('delete?id=' + id, data, function (response) {
                if (response.code === 200) {
                    layer.alert(response.msg, {icon: 1}, function () {
                        parent.location.reload();
                    });
                } else {
                    layer.alert(response.msg, {icon: 2}, function () {
                        parent.location.reload();
                    });
                }
            }, 'json');
        });
    });
</script>

<?php
/**
 * @name: SailShop System
 * @author: 游梦惊园
 * @link: https://github.com/duanbiaowu/sailshop
 * @blog: http://www.cnblogs.com/duanbiaowu
 * @copyright: Copyright (c) 2016 SailShop System
 * @date: 2015-11-06
 */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Modal;

$this->title = '地区管理';
$this->params['breadcrumbs'][] = $this->title;

Modal::begin([
    'options' => [
        'id' => 'js-city-district',
        'data-link' => Url::toRoute(['system/area/view', 'pid' => '']),
    ],
    'size' => 'modal-lg',
    'footer' => Html::button('关闭', [
        'class' => 'btn btn-default',
        'data-dismiss' => 'modal',
    ]),
]);

Modal::end();

?>

<?php foreach($provinces as $province): ?>
<div class="panel panel-default">
    <div class="panel-body">
        <div class="col-sm-2">
        <h5><?= $province['name'] ?></h5>
        </div>
        <div class="col-sm-3">
            <?= Html::button('查看所有市区', [
                'class' => 'btn btn-success btn-sm js-city-district',
                'data-pid' => $province['id'],
            ]); ?>
        </div>
    </div>
</div>
<?php endforeach; ?>

<?php $this->registerJs(
<<<EOF
    var link = $("#js-city-district").data('link');
    $('.js-city-district').on('click', function() {
        $("#js-city-district").modal({remote : link + $(this).data('pid')});
    });
    $('#js-city-district').on('hidden.bs.modal', function() {
        $(this).removeData('bs.modal');
    });
    $('#js-city-district').one('show.bs.modal', function (e) {
        $('#js-city-district').removeClass('fade');
    });
    $('#js-city-district').modal('show').modal('hide');
EOF
); ?>







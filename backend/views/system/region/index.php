<?php
/**
 * @name: SailShop System
 * @author: 游梦惊园
 * @link: https://github.com/duanbiaowu/sailshop
 * @blog: http://www.cnblogs.com/duanbiaowu
 * @copyright: Copyright (c) 2016 SailShop System
 * @date: 2016-01-20
 */

use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;

/* @var $regions */
/* @var $provinces */

$this->title = '区域划分';
$this->params['breadcrumbs'][] = $this->title;

Modal::begin([
    'options' => [
        'id' => 'js-region-form',
        'backdrop' => 'static',
        'keyboard' => 'false',
    ],
    'size' => 'modal-lg',
    'toggleButton' => [
        'tag' => 'button',
        'label' => '创建区域',
        'class' => 'js-region-view btn btn-success',
        'data-link' => Url::toRoute('system/region/create'),
    ],
]);

Modal::end();

?>

<div class="form-group"></div>

<?php foreach (ArrayHelper::toArray($regions) as $region): ?>
<div class="panel panel-default">
    <div class="panel-body">
        <div class="col-lg-1 col-sm-1 col-xs-12">
            <label class="text-primary"><?= $region['name'] ?></label>
        </div>
        <div class="col-sm-9">
            <?php foreach ($region['provinces'] as $province): ?>
            <?= $provinces[$province]['name']; ?>&nbsp;&nbsp;&nbsp;
            <?php endforeach; ?>
        </div>
        <div class="col-sm-2 text-right">
            <button type="button" class="js-region-view btn btn-primary btn-sm" data-link="<?= Url::toRoute(['update', 'id' => $region['id']]) ?>">编辑</button>
            <?= Html::a('删除', ['delete', 'id' => $region['id']], [
                'class' => 'btn btn-danger btn-sm',
                'data' => [
                    'confirm' => Yii::t('System', 'common_delete_confirm'),
                    'method' => 'post',
                ],
            ]) ?>
        </div>
    </div>
</div>
<?php endforeach; ?>

<?php $this->registerJs(
<<<EOF
    $('.js-region-view').on('click', function() {
        $.get($(this).data('link'), function(response) {
            $('#js-region-form').html(response).modal();
        });
    });
EOF
); ?>


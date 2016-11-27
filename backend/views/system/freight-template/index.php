<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $freightTemplates */

$this->title = Yii::t('System', 'Freight Templates');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="freight-template-index">

    <p>
        <?= Html::a(Yii::t('System', 'Create Freight Template'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php foreach ($freightTemplates as $template): ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <strong class="text-danger"><?= $template['name'] ?></strong>
            <div class="pull-right">
                <?= Html::a('<span class="glyphicon glyphicon-eye-open"></span>', ['/system/freight-template/view', 'id' => $template['id']], [
                    'class' => 'text-danger',
                ]) ?>
                &nbsp;&nbsp;&nbsp;&nbsp;

                <?= Html::a('<span class="glyphicon glyphicon-edit"></span>', ['/system/freight-template/update', 'id' => $template['id']], [
                    'class' => 'text-danger',
                ]) ?>
                &nbsp;&nbsp;&nbsp;&nbsp;

                <?= Html::a('<span class="glyphicon glyphicon-remove"></span>', ['/system/freight-template/delete', 'id' => $template['id']], [
                    'class' => 'text-danger',
                    'data' => [
                        'confirm' => Yii::t('System', 'common_delete_confirm'),
                        'method' => 'post',
                    ],
                ]) ?>
            </div>
        </div>
        <div class="panel-body row">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th width="60%" class="text-center"><?= Yii::t('System', 'Freight Area') ?></th>
                    <th width="10%" class="text-center"><?= Yii::t('System', 'Freight Weight') ?> (g)</th>
                    <th width="10%" class="text-center"><?= Yii::t('System', 'Freight Cost') ?></th>
                    <th width="10%" class="text-center"><?= Yii::t('System', 'Freight Append Weight') ?> (g)</th>
                    <th width="10%" class="text-center"><?= Yii::t('System', 'Freight Append Cost') ?></th>
                </tr>
                </thead>
                <tbody class="js-template-container">
                <tr>
                    <td height="50">
                        <div class="col-sm-9">
                            <strong><?= Yii::t('System', 'Freight Template Default'); ?></strong>
                        </div>
                        <div class="col-sm-3">
                            <?php if ($template['districts']): ?>
                            <a href="javascript:;" class="js-district-view"><strong>查看指定城市运费</strong></a>
                            <?php endif; ?>
                        </div>
                    </td>
                    <td class="text-primary text-center"><?= $template['weight'] ?></td>
                    <td class="text-danger text-center"><?= $template['weight'] ?></td>
                    <td class="text-primary text-center"><?= $template['weight'] ?></td>
                    <td class="text-danger text-center"><?= $template['weight'] ?></td>
                </tr>
                <?php foreach ($template['districts'] as $district): ?>
                <tr class="js-template-district" style="display: none;">
                    <td>
                        <?php foreach($district['name'] as $name): ?>
                            <div class="col-sm-3"><strong><?= $name; ?></strong></div>
                        <?php endforeach; ?>
                    </td>
                    <td class="text-primary text-center"><?= $district['weight'] ?></td>
                    <td class="text-danger text-center"><?= $district['weight'] ?></td>
                    <td class="text-primary text-center"><?= $district['weight'] ?></td>
                    <td class="text-danger text-center"><?= $district['weight'] ?></td>
                </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="panel-footer">
            <?php if ($template['default']): ?>
            <strong class="text-danger">( 当前模板正在使用中 )</strong>
            <?php else: ?>
            <?= Html::a('将此模板设置为默认模板', ['/system/freight-template/default', 'id' => $template['id']], [
                'class' => 'btn btn-primary btn-sm',
                'data' => [
                    'confirm' => '模板更换后将会影响用户购物运费计算方式',
                    'method' => 'post',
                ],
            ]) ?>
            <?php endif; ?>
        </div>
    </div>
    <?php endforeach; ?>
</div>

<?php $this->registerJs(
<<<EOF
    $('.js-district-view').on('click', function() {
        var index = $('.js-district-view').index($(this));
        $('.js-template-container').eq(index).find('.js-template-district').toggle();
    });    
EOF
) ?>

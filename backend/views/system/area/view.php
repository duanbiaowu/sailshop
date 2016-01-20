<?php
/**
 * @name: SailShop System
 * @author: 游梦惊园
 * @link: https://github.com/duanbiaowu/sailshop
 * @blog: http://www.cnblogs.com/duanbiaowu
 * @copyright: Copyright (c) 2016 SailShop System
 * @date: 2015-11-06
 */

/* @var $this yii\web\View */
/* @var $model backend\models\system\Area */
/* @var $cities */

$this->title = '地区管理';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><?= $model->name ?></h4>
    </div>
    <div class="modal-body">
        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
            <?php foreach ($cities as $city): ?>
            <div class="panel panel-default">
                <div class="panel-body" role="tab" id="headingOne">
                    <h4 class="panel-title">
                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne-<?= $city['id'] ?>" aria-expanded="false" aria-controls="collapseOne">
                            <?= $city['name'] ?>
                        </a>
                    </h4>
                </div>
                <div id="collapseOne-<?= $city['id'] ?>" class="panel-body collapse" role="tabpanel" aria-labelledby="headingOne">
                    <?php foreach ($city['districts'] as $district): ?>
                        <div class="col-sm-3">
                        <button type="button" class="btn btn-default col-sm-12 help-block"><?= $district['name'] ?></button>
                        </div>
                    <?php endforeach ?>
                </div>
            </div>
            <?php endforeach ?>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
    </div>
</div>










<?php
/**
 * @name: SailShop System
 * @author: 游梦惊园
 * @link: https://github.com/duanbiaowu/sailshop
 * @blog: http://www.cnblogs.com/duanbiaowu
 * @copyright: Copyright (c) 2016 SailShop System
 * @date: 2016-01-26
 */

use yii\helpers\Html;

/* @var $backupFiles */

$this->title = '数据库还原';
$this->params['breadcrumbs'][] = $this->title;

?>

<?= $this->render('_label'); ?>

<?php if ($backupFiles): ?>

<?php foreach ($backupFiles as $file): ?>
<div class="panel panel-default">
    <div class="panel-body">
        <div class="col-sm-8">
            <h5><strong><?= strrchr($file, '/') ?></strong></h5>
        </div>
        <div class="col-sm-4">
            <div class="pull-right">
                <a href="#" class="btn btn-primary"><i class="fa fa-backward"></i> 还原</a>
                <a href="#" class="btn btn-success"><i class="fa fa-cloud-download"></i> 下载</a>
                <a href="#" class="btn btn-danger"><i class="fa fa-remove"></i> 删除</a>
            </div>
        </div>
    </div>
</div>
<?php endforeach; ?>

<?php else: ?>
<div class="alert alert-warning">
    系统当前没有任何数据库备份文件。
</div>
<?php endif; ?>

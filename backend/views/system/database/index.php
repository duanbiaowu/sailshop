<?php
/**
 * @name: SailShop System
 * @author: 游梦惊园
 * @link: https://github.com/duanbiaowu/sailshop
 * @blog: http://www.cnblogs.com/duanbiaowu
 * @copyright: Copyright (c) 2016 SailShop System
 * @date: 2016-01-25
 */

use yii\helpers\Html;

/* @var $tables */
/* @var $model backend\models\system\Database */

$this->title = '数据库概况';
$this->params['breadcrumbs'][] = $this->title;

?>

<?= $this->render('_label') ?>

<?= Html::a('优化数据库', ['optimize'], [
    'class' => 'btn btn-success',
    'data' => [
        'confirm' => '优化过程可能需要一些时间，确认优化？',
        'method' => 'post',
    ],
]) ?>

<?= Html::a('备份数据库', ['backup'], [
    'class' => 'btn btn-warning',
    'data' => [
        'confirm' => '备份过程可能需要一些时间，确认备份？',
        'method' => 'post',
    ],
]) ?>


<div class="form-group"></div>

<table class="table table-hover">
    <thead>
    <tr>
        <th>数据表名</th>
        <th>存储引擎</th>
        <th>记录行数</th>
        <th>数据空间</th>
        <th>索引空间</th>
        <th>多余碎片</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($tables as $table): ?>
    <tr>
        <td><?= $table['Name'] ?></td>
        <td><?= $table['Engine'] ?></td>
        <td><?= $table['Rows'] ?></td>
        <td><?= $model->format($table['Data_length']) ?></td>
        <td><?= $model->format($table['Index_length']) ?></td>
        <td><?= $model->format($table['Data_free']) ?></td>
    </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/* @var $model common\models\goods\Goods */
/* @var $specs */
/* @var $sku */
?>

<div class="form-group">
    <div class="col-sm-3">
        <ul class="list-group">
            <?php foreach ($specs as $spec): ?>
            <a href="#js-spec-group-<?= $spec['id'] ?>" class="list-group-item" data-toggle="tab" aria-expanded="false">
                <span class="badge"><?= $spec['total'] ?></span>
                <?= $spec['name'] ?>
            </a>
            <?php endforeach; ?>
        </ul>
    </div>

    <div class="col-sm-9">
        <div class="tab-content">
            <?php foreach ($specs as $spec): ?>
            <div class="tab-pane fade <?php if ($spec['id'] == array_keys($specs)[0]) echo 'in active';?>" id="js-spec-group-<?= $spec['id'] ?>">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <label class="checkbox-inline">
                            <input type="checkbox" class="col-sm-3 js-check-all" name="">全选
                        </label>
                    </div>
                    <div class="panel-body js-spec-item">
                        <?php foreach ($spec['children'] as $child): ?>
                        <div class="col-sm-3 help-block">
                            <label class="checkbox-inline">
                                <?= Html::checkbox('', !$model->isNewRecord && in_array($child['id'], $sku['index']), [
                                    'value' => $child['id'],
                                    'data-title' => $child['name'],
                                ]) ?>
                                <?= $child['name'] ?>
                            </label>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

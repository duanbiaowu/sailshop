<?php

use backend\models\system\Role;
use backend\models\system\UserRole;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\system\User */
/* @var $form yii\widgets\ActiveForm */
/* @var Role[] $roles */
/* @var UserRole[] $userRoles */

$this->title = Yii::t('System', 'Update') . ' ' . $model->username;
$this->params['breadcrumbs'][] = ['label' => Yii::t('System', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->username, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '更新角色';

?>

<?php $form = ActiveForm::begin([
    'id' => 'user-role-form',
    'options' => [
        'class' => 'form-horizontal',
    ]
]); ?>

<div class="panel panel-default">
    <div class="panel-heading">
        请设置操作用户角色
    </div>

    <div class="panel-body">
        <?php foreach ($roles as $role): ?>
        <div class="col-sm-2 help-block">
            <label class="checkbox-inline">
                <input type="checkbox" name="roleIds[]" value="<?= $role['id'] ?>" <?php if (isset($userRoles[$role['id']])): ?>checked<?php endif; ?>><?= $role['name'] ?>
            </label>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<div class="form-group col-sm-12">
    <?= Html::submitButton($model->isNewRecord ? Yii::t('System', 'Create') : Yii::t('System', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success col-sm-1' : 'btn btn-primary col-sm-1']) ?>
</div>

<?php ActiveForm::end(); ?>


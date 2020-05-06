<?php

namespace backend\models\system;

use Yii;

/**
 * This is the model class for table "{{%role_menu_permission}}".
 *
 * @property integer $role_id
 * @property integer $permission_id
 *
 * @property Role $role
 * @property MenuPermission $permission
 */
class RoleMenuPermission extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%role_menu_permission}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['role_id', 'permission_id'], 'required'],
            [['role_id', 'permission_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'role_id' => 'Role ID',
            'permission_id' => 'Permission ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRole()
    {
        return $this->hasOne(Role::className(), ['id' => 'role_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPermission()
    {
        return $this->hasOne(MenuPermission::className(), ['id' => 'permission_id']);
    }
}

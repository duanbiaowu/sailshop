<?php

namespace backend\models\system;

use Yii;

/**
 * This is the model class for table "{{%menu_permission}}".
 *
 * @property integer $id
 * @property integer $menu_id
 * @property string $name
 * @property string $method
 * @property string $query
 *
 * @property AuthMenu $menu
 * @property RoleMenuPermission[] $roleMenuPermissions
 */
class MenuPermission extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%menu_permission}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['menu_id', 'name'], 'required'],
            [['menu_id'], 'integer'],
            [['name'], 'string', 'max' => 32],
            [['method'], 'string', 'max' => 8],
            [['query'], 'string', 'max' => 256]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'menu_id' => 'Menu ID',
            'name' => 'Name',
            'method' => 'Method',
            'query' => 'Query',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMenu()
    {
        return $this->hasOne(AuthMenu::className(), ['id' => 'menu_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRoleMenuPermissions()
    {
        return $this->hasMany(RoleMenuPermission::className(), ['permission_id' => 'id']);
    }
}

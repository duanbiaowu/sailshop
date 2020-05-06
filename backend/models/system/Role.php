<?php

namespace backend\models\system;

use Yii;

/**
 * This is the model class for table "{{%role}}".
 *
 * @property integer $id
 * @property string $name
 */
class Role extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%role}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 32]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '名称',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMenuPermissions()
    {
        return $this->hasMany(RoleMenuPermission::className(), ['role_id' => 'id']);
    }
}

<?php

namespace backend\models\system;

use Yii;

/**
 * This is the model class for table "{{%user_operate_log}}".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $username
 * @property string $menu_name
 * @property string $permission
 * @property string $query
 * @property string $create_time
 */
class UserOperateLog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user_operate_log}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'username', 'menu_name', 'permission', 'query'], 'required'],
            [['user_id'], 'integer'],
            [['create_time'], 'safe'],
            [['username'], 'string', 'max' => 32],
            [['menu_name', 'permission', 'query'], 'string', 'max' => 256]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'username' => 'Username',
            'menu_name' => 'Menu Name',
            'permission' => 'Permission',
            'query' => 'Query',
            'create_time' => 'Create Time',
        ];
    }
}

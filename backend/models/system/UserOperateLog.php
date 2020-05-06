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
            [['user_id', 'username', 'menu_name', 'permission'], 'required'],
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
            'user_id' => '用户ID',
            'username' => '昵称',
            'menu_name' => '菜单名称',
            'permission' => '操作',
            'query' => '查询参数',
            'create_time' => '时间',
        ];
    }
}

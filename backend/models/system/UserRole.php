<?php

namespace backend\models\system;

use Yii;

/**
 * This is the model class for table "{{%user_role}}".
 *
 * @property string $user_id
 * @property integer $role_id
 */
class UserRole extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user_role}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'role_id'], 'required'],
            [['role_id'], 'integer'],
            [['user_id'], 'string', 'max' => 32]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'role_id' => 'Role ID',
        ];
    }
}

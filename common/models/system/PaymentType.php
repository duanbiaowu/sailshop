<?php

namespace common\models\system;

use Yii;

/**
 * This is the model class for table "payment_type".
 *
 * @property integer $id
 * @property string $name
 * @property string $app_key
 * @property string $app_secret
 * @property string $description
 * @property integer $sort
 * @property integer $status
 */
class PaymentType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'payment_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['sort', 'status'], 'integer'],
            [['name', 'app_key'], 'string', 'max' => 128],
            [['app_secret'], 'string', 'max' => 256],
            [['description'], 'string', 'max' => 1024]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'app_key' => 'App Key',
            'app_secret' => 'App Secret',
            'description' => 'Description',
            'sort' => 'Sort',
            'status' => 'Status',
        ];
    }
}

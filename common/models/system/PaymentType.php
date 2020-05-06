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
 * @property string $logo
 */
class PaymentType extends \yii\db\ActiveRecord
{
    const ENABLE_STATUS = 0x01;

    const DISABLE_STATUS = 0x00;

    const DEPOSIT_PAY_TYPE = 0x01;

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
            [['name', 'app_key', 'logo'], 'string', 'max' => 128],
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
            'name' => Yii::t('System', 'Payment Name'),
            'app_key' => 'App Key',
            'app_secret' => 'App Secret',
            'description' => Yii::t('System', 'Payment Description'),
            'sort' => Yii::t('System', 'Payment Sort'),
            'status' => Yii::t('System', 'Payment Status'),
            'logo' => 'Logo',
        ];
    }
}

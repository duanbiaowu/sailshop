<?php

namespace backend\models\system;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%express_company}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $identifier
 * @property string $code
 * @property string $url
 * @property integer $sort
 * @property integer $available
 */
class ExpressCompany extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%express_company}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'identifier', 'code', 'url'], 'required'],
            [['sort', 'available'], 'integer'],
            [['name', 'identifier', 'code', 'url'], 'string', 'max' => 32],
            ['sort', 'default', 'value' => 0],
            ['available', 'boolean', 'strict' => true],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => Yii::t('system', 'form_express_company_name'),
            'identifier' => Yii::t('system', 'form_express_company_identifier'),
            'code' => Yii::t('system', 'form_express_company_code'),
            'url' => Yii::t('system', 'form_express_company_url'),
            'sort' => Yii::t('system', 'form_express_company_sort'),
            'available' => Yii::t('system', 'form_express_company_available'),
        ];
    }

    public function availableLabel()
    {
        return [
            '1' => Yii::t('System', 'common_available'),
            '0' => Yii::t('System', 'common_disable'),
        ];
    }
}

<?php

namespace common\models\goods;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%brand}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $url
 * @property string $logo
 * @property integer $sort
 * @property integer $available
 */
class Brand extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%brand}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'url'], 'required'],
            [['sort', 'available'], 'integer'],
            [['name'], 'string', 'max' => 64],
            [['url'], 'string', 'max' => 255],
            [['logo'], 'file', 'skipOnEmpty' => false, 'extensions' => 'jpg, png'],
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
            'name' => Yii::t('Goods', 'brand_name'),
            'url' => Yii::t('Goods', 'brand_url'),
            'logo' => Yii::t('Goods', 'brand_logo'),
            'sort' => Yii::t('Goods', 'brand_sort'),
            'available' => Yii::t('Goods', 'brand_available'),
        ];
    }

}

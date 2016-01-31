<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%goods}}".
 *
 * @property integer $id
 * @property string $name
 * @property integer $category_id
 * @property integer $type_id
 * @property integer $brand_id
 * @property string $unit
 * @property string $thumbnail
 * @property string $attributes
 * @property string $show_pictures
 * @property string $seo_title
 * @property string $seo_keyword
 * @property string $seo_description
 * @property string $account_count
 * @property integer $status
 * @property string $detail_link
 * @property string $modified_time
 * @property string $create_time
 * @property string $goods_sku
 */
class Goods extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%goods}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'unit', 'thumbnail', 'show_pictures', 'goods_sku'], 'required'],
            [['category_id', 'type_id', 'brand_id', 'account_count', 'status'], 'integer'],
            [['modified_time', 'create_time'], 'safe'],
            [['name', 'thumbnail', 'seo_title'], 'string', 'max' => 128],
            [['unit'], 'string', 'max' => 16],
            [['attributes'], 'string', 'max' => 1024],
            [['show_pictures', 'goods_sku'], 'string', 'max' => 2048],
            [['seo_keyword', 'seo_description', 'detail_link'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('System', 'ID'),
            'name' => Yii::t('System', 'Name'),
            'category_id' => Yii::t('System', 'Category ID'),
            'type_id' => Yii::t('System', 'Type ID'),
            'brand_id' => Yii::t('System', 'Brand ID'),
            'unit' => Yii::t('System', 'Unit'),
            'thumbnail' => Yii::t('System', 'Thumbnail'),
            'attributes' => Yii::t('System', 'Attributes'),
            'show_pictures' => Yii::t('System', 'Show Pictures'),
            'seo_title' => Yii::t('System', 'Seo Title'),
            'seo_keyword' => Yii::t('System', 'Seo Keyword'),
            'seo_description' => Yii::t('System', 'Seo Description'),
            'account_count' => Yii::t('System', 'Account Count'),
            'status' => Yii::t('System', 'Status'),
            'detail_link' => Yii::t('System', 'Detail Link'),
            'modified_time' => Yii::t('System', 'Modified Time'),
            'create_time' => Yii::t('System', 'Create Time'),
            'goods_sku' => Yii::t('System', 'Goods Sku'),
        ];
    }
}

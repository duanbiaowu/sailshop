<?php

namespace common\models\goods;

use Yii;

/**
 * This is the model class for table "{{%goods}}".
 *
 * @property integer $id
 * @property string $name
 * @property integer $category_id
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
class Goods extends \yii\db\ActiveRecord
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
            [['category_id', 'brand_id', 'account_count', 'status'], 'integer'],
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
            'name' => Yii::t('Goods', 'Goods Name'),
            'category_id' => Yii::t('Goods', 'Goods Category ID'),
            'unit' => Yii::t('Goods', 'Goods Unit'),
            'thumbnail' => Yii::t('Goods', 'Goods Thumbnail'),
            'attributes' => Yii::t('Goods', 'Attributes'),
            'show_pictures' => Yii::t('Goods', 'Goods Show Pictures'),
            'seo_title' => Yii::t('Goods', 'Goods Seo Title'),
            'seo_keyword' => Yii::t('Goods', 'Goods Seo Keyword'),
            'seo_description' => Yii::t('Goods', 'Goods Seo Description'),
            'status' => Yii::t('Goods', 'Goods Status'),
        ];
    }
}

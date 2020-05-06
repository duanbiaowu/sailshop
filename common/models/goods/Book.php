<?php

namespace common\models\goods;

use Yii;

/**
 * This is the model class for table "{{%book}}".
 *
 * @property string $isbn
 * @property string $name
 * @property integer $category_id
 * @property integer $brand_id
 * @property string $thumbnail
 * @property string $show_pictures
 * @property string $translator
 * @property integer $pages
 * @property string $binding
 * @property integer $weight
 * @property string $publish_date
 * @property string $introduce
 * @property string $price
 * @property integer $stock
 * @property integer $status
 * @property string $modified_time
 * @property string $create_time
 */
class Book extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%book}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['isbn', 'name', 'category_id', 'brand_id', 'pages', 'binding', 'weight', 'price', 'stock'], 'required'],
            [['category_id', 'brand_id', 'pages', 'weight', 'stock', 'status'], 'integer'],
            [['publish_date', 'modified_time', 'create_time'], 'safe'],
            [['price'], 'number'],
            [['isbn'], 'string', 'max' => 13],
            [['name', 'thumbnail', 'translator'], 'string', 'max' => 128],
            [['show_pictures', 'introduce'], 'string', 'max' => 2048],
            [['binding'], 'string', 'max' => 32],
            [['isbn'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'isbn' => 'Isbn',
            'name' => 'Name',
            'category_id' => 'Category ID',
            'brand_id' => 'Brand ID',
            'thumbnail' => 'Thumbnail',
            'show_pictures' => 'Show Pictures',
            'translator' => 'Translator',
            'pages' => 'Pages',
            'binding' => 'Binding',
            'weight' => 'Weight',
            'publish_date' => 'Publish Date',
            'introduce' => 'Introduce',
            'price' => 'Price',
            'stock' => 'Stock',
            'status' => 'Status',
            'modified_time' => 'Modified Time',
            'create_time' => 'Create Time',
        ];
    }
}

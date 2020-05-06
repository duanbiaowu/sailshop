<?php

namespace common\models\goods;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\Url;

/**
 * This is the model class for table "{{%goods_category}}".
 *
 * @property integer $id
 * @property string $name
 * @property integer $parent_id
 * @property integer $type_id
 * @property string $path
 * @property integer $sort
 * @property string $seo_title
 * @property string $set_keyword
 * @property string $seo_description
 */
class Category extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%book_category}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['parent_id', 'sort'], 'integer'],
            [['name', 'seo_description'], 'string', 'max' => 255],
            [['path'], 'string', 'max' => 2048],
            [['seo_title'], 'string', 'max' => 64],
            [['set_keyword'], 'string', 'max' => 128],
            ['sort', 'default', 'value' => 1],
            ['parent_id', 'in', 'range' => array_keys($this->category()), 'allowArray' => true]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('Goods', 'ID'),
            'name' => Yii::t('Goods', 'name'),
            'parent_id' => Yii::t('Goods', 'parent_id'),
            'type_id' => Yii::t('Goods', 'type_id'),
            'path' => Yii::t('Goods', 'path'),
            'sort' => Yii::t('Goods', 'sort'),
            'seo_title' => Yii::t('Goods', 'seo_title'),
            'set_keyword' => Yii::t('Goods', 'set_keyword'),
            'seo_description' => Yii::t('Goods', 'seo_description'),
        ];
    }

    public function category()
    {
        $categories = Category::find()
            ->addSelect(['id', 'name', 'parent_id'])
            ->indexBy('id')
            ->asArray()
            ->all();

        foreach ($categories as &$category) {
            $category['view'] = Url::toRoute(['/goods/category/view', 'id' => $category['id']]);
            $category['update'] = Url::toRoute(['/goods/category/update', 'id' => $category['id']]);
            $category['delete'] = Url::toRoute(['/goods/category/delete', 'id' => $category['id']]);
        }

        $categories[0] = [
            'id' => 0,
            'name' => Yii::t('Goods', 'Category Form Prompt'),
        ];

        return $categories;
    }

    public function beforeSave($insert)
    {
        if ($this->parent_id > 0) {
            $parent = Category::findOne($this->parent_id);
            $this->path = $parent->path . '|' . $this->parent_id;
        } else {
            $this->path = '';
        }
        return parent::beforeSave($insert); // TODO: Change the autogenerated stub
    }

    public function afterSave($insert, $changedAttributes)
    {
        $children = Category::find()
            ->where(['LIKE', 'path', '|' . $this->id])
            ->all();

        if ($children) {
            foreach ($children as $model) {
                $model->path = $this->path . substr($model->path, strpos($model->path, '|' . $this->id));
                $model->save();
            }
        }
        parent::afterSave($insert, $changedAttributes); // TODO: Change the autogenerated stub
    }

    public static function parentFormat($path)
    {
        $parentText = '';

        if ($condition = explode('|', $path)) {
            $categories = Category::find()
                ->where(['id' => $condition])
                ->asArray()
                ->all();

            foreach ($categories as $category) {
                $parentText .= $category['name'] . ' - ';
            }
        }
        return rtrim($parentText, ' - ');
    }

    public function arrayToTree($items)
    {
        foreach ($items as $item) {
            if (isset($item['parent_id'])) {
                $items[$item['parent_id']]['children'][$item['id']] = &$items[$item['id']];
            }
        }
        return isset($items[0]['children']) ? $items[0]['children'] : [];
    }

    public function arrayToList($items, &$target, $depth = 0)
    {
        foreach ($items as $item) {
            $target[$item['id']] = str_repeat('──', $depth) . $item['name'];
            if (!empty($item['children'])) {
                $this->arrayToList($item['children'], $target, $depth + 1);
            }
        }
    }

    public function afterDelete()
    {
        Category::deleteAll(['LIKE', 'path', '|' . $this->id]);
        parent::afterDelete(); // TODO: Change the autogenerated stub
    }

    /**
     * @return Category[]
     */
    public function getAncestors()
    {
        return Category::findAll(['id' => array_filter(explode('|', $this->path))]);
    }
}

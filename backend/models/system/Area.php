<?php

namespace backend\models\system;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%area}}".
 *
 * @property integer $id
 * @property string $name
 * @property integer $parent_id
 * @property integer $sort
 */
class Area extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%area}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['parent_id', 'sort'], 'integer'],
            [['name'], 'string', 'max' => 255],
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
            'parent_id' => 'Parent ID',
            'sort' => 'Sort',
        ];
    }

    public static function getProvinces()
    {
        return self::find()
            ->where(['parent_id' => 0])
            ->indexBy('id')
            ->asArray()
            ->all();
    }
}

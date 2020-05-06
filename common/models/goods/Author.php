<?php

namespace common\models\goods;

use Yii;

/**
 * This is the model class for table "{{%author}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $url
 * @property string $logo
 * @property integer $sort
 * @property integer $available
 */
class Author extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%author}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'logo'], 'required'],
            [['sort', 'available'], 'integer'],
            [['name'], 'string', 'max' => 64],
            [['url', 'logo'], 'string', 'max' => 255]
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
            'url' => 'Url',
            'logo' => 'Logo',
            'sort' => 'Sort',
            'available' => 'Available',
        ];
    }
}

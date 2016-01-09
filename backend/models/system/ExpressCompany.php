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
            [['name', 'identifier', 'code', 'url'], 'string', 'max' => 32]
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
            'identifier' => 'Identifier',
            'code' => 'Code',
            'url' => 'Url',
            'sort' => 'Sort',
            'available' => 'Available',
        ];
    }
}

<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%member_cart}}".
 *
 * @property integer $member_id
 * @property string $isbn
 * @property integer $count
 * @property string $create_time
 *
 * @property Member $member
 * @property Book $isbn0
 */
class MemberCart extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%member_cart}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['member_id', 'isbn', 'count'], 'required'],
            [['member_id', 'count'], 'integer'],
            [['create_time'], 'safe'],
            [['isbn'], 'string', 'max' => 13]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'member_id' => Yii::t('app', 'Member ID'),
            'isbn' => Yii::t('app', 'Isbn'),
            'count' => Yii::t('app', 'Count'),
            'create_time' => Yii::t('app', 'Create Time'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMember()
    {
        return $this->hasOne(Member::className(), ['id' => 'member_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIsbn0()
    {
        return $this->hasOne(Book::className(), ['isbn' => 'isbn']);
    }
}

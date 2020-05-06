<?php

namespace common\models;

use common\models\goods\Book;
use Yii;

/**
 * This is the model class for table "{{%member_browse_record}}".
 *
 * @property integer $member_id
 * @property string $isbn
 * @property integer $views
 * @property string $last_time
 *
 * @property Member $member
 * @property Book $isbn0
 */
class MemberBrowseRecord extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%member_browse_record}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['member_id', 'isbn'], 'required'],
            [['member_id', 'views'], 'integer'],
            [['isbn'], 'string', 'max' => 13],
            ['views', 'default', 'value' => 1],
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
            'views' => Yii::t('app', 'Views'),
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
    public function getIsbn()
    {
        return $this->hasOne(Book::className(), ['isbn' => 'isbn']);
    }

    public function increaseViews()
    {
        MemberBrowseRecord::updateAllCounters(['views' => 1], [
            'member_id' => $this->member_id,
            'isbn' => $this->isbn,
        ]);
    }
}

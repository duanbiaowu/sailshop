<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%member_account_record}}".
 *
 * @property integer $id
 * @property integer $member_id
 * @property string $value
 * @property string $remark
 * @property string $create_time
 *
 * @property Member $member
 */
class MemberAccountRecord extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%member_account_record}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['member_id', 'value', 'remark'], 'required'],
            [['member_id'], 'integer'],
            [['value'], 'number'],
            [['create_time'], 'safe'],
            [['remark'], 'string', 'max' => 32]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'member_id' => Yii::t('app', 'Member ID'),
            'value' => Yii::t('app', 'Value'),
            'remark' => Yii::t('app', 'Remark'),
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
}

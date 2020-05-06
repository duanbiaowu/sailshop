<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%member_shipping_address}}".
 *
 * @property integer $id
 * @property integer $member_id
 * @property integer $is_default
 * @property string $name
 * @property string $mobile
 * @property string $remark
 * @property integer $province_id
 * @property string $province_name
 * @property integer $city_id
 * @property string $city_name
 * @property integer $district_id
 * @property string $district_name
 * @property string $detail_address
 * @property string $create_time
 *
 * @property Member $member
 */
class MemberShippingAddress extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%member_shipping_address}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['member_id', 'is_default', 'name', 'mobile', 'remark', 'province_id', 'province_name', 'city_id', 'city_name', 'district_id', 'district_name', 'detail_address'], 'required'],
            [['member_id', 'is_default', 'province_id', 'city_id', 'district_id'], 'integer'],
            [['create_time'], 'safe'],
            [['name'], 'string', 'max' => 32],
            [['mobile'], 'string', 'max' => 11],
            [['remark', 'detail_address'], 'string', 'max' => 1024],
            [['province_name'], 'string', 'max' => 16],
            [['city_name'], 'string', 'max' => 64],
            [['district_name'], 'string', 'max' => 256]
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
            'is_default' => Yii::t('app', 'Is Default'),
            'name' => Yii::t('app', 'Name'),
            'mobile' => Yii::t('app', 'Mobile'),
            'remark' => Yii::t('app', 'Remark'),
            'province_id' => Yii::t('app', 'Province ID'),
            'province_name' => Yii::t('app', 'Province Name'),
            'city_id' => Yii::t('app', 'City ID'),
            'city_name' => Yii::t('app', 'City Name'),
            'district_id' => Yii::t('app', 'District ID'),
            'district_name' => Yii::t('app', 'District Name'),
            'detail_address' => Yii::t('app', 'Detail Address'),
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

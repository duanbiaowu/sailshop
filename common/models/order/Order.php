<?php

namespace common\models\order;

use Yii;

/**
 * This is the model class for table "{{%order}}".
 *
 * @property integer $id
 * @property integer $member_id
 * @property string $price_count
 * @property integer $status
 * @property string $finish_time
 * @property integer $pay_type
 * @property string $pay_time
 * @property integer $express_type
 * @property string $express_code
 * @property string $remark
 * @property string $name
 * @property string $mobile
 * @property integer $province_id
 * @property integer $city_id
 * @property integer $district_id
 * @property string $detail_address
 * @property string $create_time
 *
 * @property Member $member
 * @property OrderAppraise[] $orderAppraises
 * @property OrderDetail[] $orderDetails
 * @property OrderExpressInfo[] $orderExpressInfos
 */
class Order extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%order}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['member_id', 'price_count', 'status', 'express_code', 'remark', 'name', 'mobile', 'province_id', 'city_id', 'district_id', 'detail_address'], 'required'],
            [['member_id', 'status', 'pay_type', 'express_type', 'province_id', 'city_id', 'district_id'], 'integer'],
            [['price_count'], 'number'],
            [['finish_time', 'pay_time', 'create_time'], 'safe'],
            [['express_code', 'name'], 'string', 'max' => 32],
            [['remark', 'detail_address'], 'string', 'max' => 1024],
            [['mobile'], 'string', 'max' => 11]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'member_id' => 'Member ID',
            'price_count' => 'Price Count',
            'status' => 'Status',
            'finish_time' => 'Finish Time',
            'pay_type' => 'Pay Type',
            'pay_time' => 'Pay Time',
            'express_type' => 'Express Type',
            'express_code' => 'Express Code',
            'remark' => 'Remark',
            'name' => 'Name',
            'mobile' => 'Mobile',
            'province_id' => 'Province ID',
            'city_id' => 'City ID',
            'district_id' => 'District ID',
            'detail_address' => 'Detail Address',
            'create_time' => 'Create Time',
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
    public function getOrderAppraises()
    {
        return $this->hasMany(OrderAppraise::className(), ['order_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderDetails()
    {
        return $this->hasMany(OrderDetail::className(), ['order_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderExpressInfos()
    {
        return $this->hasMany(OrderExpressInfo::className(), ['order_id' => 'id']);
    }
}

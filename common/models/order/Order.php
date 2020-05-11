<?php

namespace common\models\order;

use common\models\Member;
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
 * @property string $province_name
 * @property integer $city_id
 * @property string $city_name
 * @property integer $district_id
 * @property string $district_name
 * @property string $zip_code
 * @property string $detail_address
 * @property string $create_time
 *
 * @property Member $member
 * @property OrderAppraise[] $orderAppraises
 * @property OrderDetail[] $orderDetails
 */
class Order extends \yii\db\ActiveRecord
{
    const CANCELED_STATUS = 0x00;

    const NOT_PAYING_STATUS = 0x01;

    const PAY_STATUS = 0x02;

    const DELIVERED_STATUS = 0x03;

    const REJECTED_STATUS = 0x04;

    const CONFIRMED_STATUS = 0x0A;

    const CONSULTED_STATUS = 0x14;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%order}}';
    }

    public static function formatStatus()
    {
        return [
            self::CANCELED_STATUS => '已取消',
            self::NOT_PAYING_STATUS => '未付款',
            self::PAY_STATUS => '已付款，未发货',
            self::DELIVERED_STATUS => '已发货',
            self::REJECTED_STATUS => '已拒绝签收',
            self::CONFIRMED_STATUS => '已完成',
            self::CONSULTED_STATUS => '已协商完成',
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['member_id', 'price_count', 'status', 'name', 'mobile','province_id', 'province_name', 'city_id', 'city_name', 'district_id', 'district_name', 'detail_address'], 'required'],
            [['member_id', 'status', 'pay_type', 'express_type', 'province_id', 'city_id', 'district_id'], 'integer'],
            [['price_count'], 'number'],
            [['finish_time', 'pay_time', 'create_time'], 'safe'],
            [['express_code', 'name'], 'string', 'max' => 32],
            [['remark', 'detail_address'], 'string', 'max' => 1024],
            [['mobile'], 'string', 'max' => 11],
            [['province_name'], 'string', 'max' => 16],
            [['city_name'], 'string', 'max' => 64],
            [['district_name'], 'string', 'max' => 256],
            [['zip_code'], 'string', 'max' => 6]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'member_id' => '会员ID',
            'price_count' => '总价',
            'status' => '订单状态',
            'finish_time' => '完成时间',
            'pay_type' => '支付类型',
            'pay_time' => '支付时间',
            'express_type' => '快递类型',
            'express_code' => '快递单号',
            'remark' => '备注信息',
            'name' => '收货人姓名',
            'mobile' => '联系方式',
            'province_id' => '收货人省份ID',
            'province_name' => '省',
            'city_id' => '收货人城市ID',
            'city_name' => '市',
            'district_id' => '收货人区ID',
            'district_name' => '县/区',
            'zip_code' => '邮政编码',
            'detail_address' => '详细地址',
            'create_time' => '创建时间',
        ];
    }

    /**
     * 获取订单用户信息
     */
    public function getMember()
    {
        return $this->hasOne(Member::className(), ['id' => 'member_id']);
    }

    /**
     * 获取订单评价列表
     */
    public function getOrderAppraises()
    {
        return $this->hasMany(OrderAppraise::className(), ['order_id' => 'id']);
    }

    /**
     * 获取订单拆分列表
     */
    public function getOrderDetails()
    {
        return $this->hasMany(OrderDetail::className(), ['order_id' => 'id']);
    }

    /**
     * @return string
     */
    public function formatId()
    {
        return strtotime($this->create_time) . '000' . $this->id;
    }
}

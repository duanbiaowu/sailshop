<?php

namespace common\models\order;

use common\models\goods\Book;
use Yii;

/**
 * This is the model class for table "{{%order_detail}}".
 *
 * @property integer $id
 * @property integer $order_id
 * @property string $isbn
 * @property string $price
 * @property integer $number
 * @property string $create_time
 *
 * @property Order $order
 * @property Book $isbn0
 */
class OrderDetail extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%order_detail}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_id', 'isbn', 'price', 'number'], 'required'],
            [['order_id', 'number'], 'integer'],
            [['price'], 'number'],
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
            'id' => 'ID',
            'order_id' => '订单ID',
            'isbn' => '图书Isbn',
            'price' => '图书价格',
            'number' => '数量',
            'create_time' => '创建时间',
        ];
    }

    /**
     * 获取订单信息
     */
    public function getOrder()
    {
        return $this->hasOne(Order::className(), ['id' => 'order_id']);
    }

    /**
     * 获取图书信息
     */
    public function getIsbn0()
    {
        return $this->hasOne(Book::className(), ['isbn' => 'isbn']);
    }
}

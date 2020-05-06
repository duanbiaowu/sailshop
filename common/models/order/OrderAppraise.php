<?php

namespace common\models\order;

use common\models\goods\Book;
use Yii;

/**
 * This is the model class for table "{{%order_appraise}}".
 *
 * @property integer $id
 * @property integer $order_id
 * @property string $isbn
 * @property string $content
 * @property double $score
 * @property string $create_time
 *
 * @property Order $order
 * @property Book $isbn0
 */
class OrderAppraise extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%order_appraise}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_id', 'isbn', 'content', 'score'], 'required'],
            [['order_id'], 'integer'],
            [['content'], 'string'],
            [['score'], 'number'],
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
            'content' => '内容',
            'score' => '评分',
            'create_time' => 'Create Time',
        ];
    }

    /**
     * 获取评论订单信息
     */
    public function getOrder()
    {
        return $this->hasOne(Order::className(), ['id' => 'order_id']);
    }

    /**
     * 获取评论图书信息
     */
    public function getIsbn0()
    {
        return $this->hasOne(Book::className(), ['isbn' => 'isbn']);
    }
}

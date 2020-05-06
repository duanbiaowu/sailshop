<?php

namespace common\models\order;

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
            'order_id' => 'Order ID',
            'isbn' => 'Isbn',
            'content' => 'Content',
            'score' => 'Score',
            'create_time' => 'Create Time',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrder()
    {
        return $this->hasOne(Order::className(), ['id' => 'order_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIsbn0()
    {
        return $this->hasOne(Book::className(), ['isbn' => 'isbn']);
    }
}

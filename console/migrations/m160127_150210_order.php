<?php

use yii\db\Schema;
use yii\db\Migration;

class m160127_150210_order extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%order}}', [
            'id' => $this->primaryKey(),
            'order_no' => $this->string(64)->notNull(),
            'goods_id' => $this->integer(),
            'goods_name' => $this->string(128)->notNull(),
            'goods_sku_id' => $this->string(2048)->notNull(),
            'goods_price' => 'FLOAT(10, 2) NOT NULL DEFAULT 0.00',
            'goods_number' => $this->integer(),
            'total' => 'FLOAT(10, 2) NOT NULL DEFAULT 0.00',
            'thumbnail' => $this->string(128)->notNull(),
            'user_id' => $this->integer(),
            'username' => $this->string(32)->notNull(),
            'payment_way' => $this->smallInteger(),
            'status' => 'TINYINT(1) UNSIGNED NOT NULL',
            'explain' => $this->string(1024)->notNull(),
            'create_time' => "TIMESTAMP NOT NULL DEFAULT '0000-00-00 00:00:00'",
            'completed_time' => "TIMESTAMP NOT NULL DEFAULT '0000-00-00 00:00:00'",
        ], $tableOptions);

        $this->createIndex('idx_goods_id', '{{%order}}', 'goods_id');
    }

    public function down()
    {
        $this->dropTable('{{%order}}');

        echo "m160127_150210_order cannot be reverted.\n";

        return false;
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}

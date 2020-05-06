<?php

use yii\db\Schema;
use yii\db\Migration;

class m160128_133646_order_detail extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%order_detail}}', [
            'id' => $this->primaryKey(),
            'order_id' => $this->integer(),
            'accept_name' => $this->string(32)->notNull(),
            'phone' => $this->string(20)->notNull(),
            'mobile' => $this->string(20)->notNull(),
            'province' => $this->string(64)->notNull(),
            'city' => $this->string(64)->notNull(),
            'address' => $this->string(255)->notNull(),
            'post_code' => $this->string(8)->notNull(),
            'freight_id' => $this->integer(),
            'express_name' => $this->string(32)->notNull(),
            'invoice' => 'TINYINT(1) NOT NULL DEFAULT 0',
            'invoice_type' => 'TINYINT(1) NOT NULL DEFAULT 1',
            'user_remark' => $this->string(128)->notNull(),
            'admin_remark' => $this->string(255)->notNull(),
            'send_time' => "TIMESTAMP NOT NULL DEFAULT '0000-00-00 00:00:00'",
            'accept_time' => "TIMESTAMP NOT NULL DEFAULT '0000-00-00 00:00:00'",
        ], $tableOptions);

        $this->createIndex('idx_order_id', '{{%order_detail}}', 'order_id');
    }

    public function down()
    {
        $this->dropTable('{{%order_detail}}');

        echo "m160128_133646_order_detail cannot be reverted.\n";

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

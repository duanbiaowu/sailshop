<?php

use yii\db\Schema;
use yii\db\Migration;

class m160127_135643_goods_sku extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%goods_sku}}', [
            'id' => $this->primaryKey(),
            'goods_id' => $this->integer(),
            'sku_id' => $this->string(2048)->notNull(),
            'cost_price' => 'FLOAT(10,2) NOT NULL DEFAULT 0.00',
            'market_price' => 'FLOAT(10,2) NOT NULL DEFAULT 0.00',
            'sale_price' => 'FLOAT(10,2) NOT NULL DEFAULT 0.00',
            'stock' => 'int(11) UNSIGNED NOT NULL DEFAULT 0',
        ], $tableOptions);

        $this->createIndex('idx_goods_id', '{{%goods_sku}}', 'goods_id');
    }

    public function down()
    {
        $this->dropTable('{{%goods_sku}}');

        echo "m160127_135643_goods_sku cannot be reverted.\n";

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

<?php

use yii\db\Schema;
use yii\db\Migration;

class m160122_145728_goods_attribute extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%goods_attribute}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(64)->notNull(),
            'parent_id' => $this->integer()->defaultValue(0),
            'type' => 'tinyint(1) UNSIGNED NOT NULL DEFAULT 1',
            'items' => $this->string(1024)->notNull(),
            'available' => 'tinyint(1) UNSIGNED NOT NULL DEFAULT 1',
        ], $tableOptions);

        $this->createIndex('idx_parent_id', '{{%goods_attribute}}', 'parent_id');
    }

    public function down()
    {
        $this->dropTable('{{%goods_attribute}}');

        echo "m160122_142625_goods_attribute cannot be reverted.\n";

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

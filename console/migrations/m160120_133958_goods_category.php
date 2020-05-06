<?php

use yii\db\Schema;
use yii\db\Migration;

class m160120_133958_goods_category extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%goods_category}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull(),
            'parent_id' => $this->integer()->defaultValue(0),
            'type_id' => $this->integer()->defaultValue(0),
            'path' => $this->string(2048),
            'sort' => $this->integer()->defaultValue(0),
            'seo_title' => $this->string(64)->notNull(),
            'set_keyword' => $this->string(128)->notNull(),
            'seo_description' => $this->string(255)->notNull(),
        ], $tableOptions);

    }

    public function down()
    {
        $this->dropTable('{{%goods_category}}');

        echo "m160120_133958_goods_category cannot be reverted.\n";

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

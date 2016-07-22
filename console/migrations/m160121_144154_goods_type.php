<?php

use yii\db\Schema;
use yii\db\Migration;

class m160121_144154_goods_type extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%goods_type}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(32)->notNull(),
            'attributes' => $this->text()->defaultValue(''),
            'specifications' => $this->text()->defaultValue(''),
            'brands' => $this->text()->defaultValue(''),
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%goods_type}}');

        echo "m160121_144154_goods_type cannot be reverted.\n";

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

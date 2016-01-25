<?php

use yii\db\Schema;
use yii\db\Migration;

class m160120_015557_region extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%region}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(64)->notNull(),
            'provinces' => $this->string(2048)->notNull()->defaultValue(''),
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%region}}');

        echo "m160120_015557_region cannot be reverted.\n";

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

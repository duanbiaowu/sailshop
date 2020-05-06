<?php

use yii\db\Schema;
use yii\db\Migration;

class m160119_135233_brand extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%brand}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(64)->notNull(),
            'url' => $this->string(255)->notNull(),
            'logo' => $this->string(255)->notNull(),
            'sort' => $this->integer()->defaultValue(0),
            'available' => 'tinyint(1) NOT NULL DEFAULT 1',
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%brand}}');

        echo "m160119_135233_brand cannot be reverted.\n";

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

<?php

use yii\db\Schema;
use yii\db\Migration;

class m160109_015350_express_company extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%express_company}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(32)->notNull(),
            'identifier' => $this->string(32)->notNull(),
            'code' => $this->string(32)->notNull(),
            'url' => $this->string(32)->notNull(),
            'sort' => 'tinyint(1) NOT NULL DEFAULT 0',
            'available' => 'tinyint(1) NOT NULL DEFAULT 1',
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%express_company}}');

        echo "m160109_015350_express_company cannot be reverted.\n";

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

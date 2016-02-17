<?php

use yii\db\Schema;
use yii\db\Migration;

class m160203_080019_attachment extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%attachment}}', [
            'id' => $this->primaryKey(),
            'filename' => $this->string(255)->notNull(),
            'year' => $this->smallInteger()->notNull(),
            'month' => 'TINYINT(1) UNSIGNED NOT NULL',
            'day' => 'TINYINT(1) UNSIGNED NOT NULL',
            'size' => $this->string(64)->notNull(),
            'path' => $this->string(64)->notNull(),
            'thumbs' => $this->string(1024)->notNull(),
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%attachment}}');

        echo "m160203_080019_attachment cannot be reverted.\n";

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

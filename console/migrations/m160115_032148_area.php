<?php

use yii\db\Schema;
use yii\db\Migration;

class m160115_032148_area extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%area}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull(),
            'parent_id' => $this->integer()->notNull()->defaultValue(0),
            'sort' => 'tinyint(1) NOT NULL DEFAULT 0',
        ], $tableOptions);

        $this->createIndex('idx_parent_id', '{{%area}}', 'parent_id');
    }

    public function down()
    {
        $this->dropTable('{{%area}}');

        echo "m160115_023417_area cannot be reverted.\n";

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

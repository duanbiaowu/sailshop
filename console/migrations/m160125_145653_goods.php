<?php

use yii\db\Schema;
use yii\db\Migration;

class m160125_145653_goods extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%goods}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(128)->notNull(),
            'category_id' => $this->integer(),
            'type_id' => $this->integer()->defaultValue(0),
            'brand_id' => $this->integer()->defaultValue(0),
            'unit' => $this->string(16)->notNull(),
            'thumbnail' => $this->string(128)->notNull(),
            'attributes' => $this->string(1024)->notNull()->defaultValue(''),
            'show_pictures' => $this->string(2048)->notNull(),
            'seo_title' => $this->string(128)->notNull()->defaultValue(''),
            'seo_keyword' => $this->string(255)->notNull()->defaultValue(''),
            'seo_description' => $this->string(255)->notNull()->defaultValue(''),
            'account_count' => 'int(11) UNSIGNED NOT NULL DEFAULT 0',
            'status' => 'tinyint(1) UNSIGNED NOT NULL DEFAULT 1',
            'detail_link' => $this->string(255)->notNull()->defaultValue(''),
            'modified_time' => $this->timestamp()->notNull(),
            'create_time' => $this->timestamp()->notNull(),
        ], $tableOptions);

        $this->createIndex('idx_category_id', '{{%goods}}', 'category_id');
        $this->createIndex('idx_brand_id', '{{%goods}}', 'brand_id');

        $this->addColumn('{{%goods}}', 'goods_sku', 'varchar(2048) NOT NULL');
    }

    public function down()
    {
        $this->dropTable('{{%goods}}');

        echo "m160125_134600_goods cannot be reverted.\n";

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

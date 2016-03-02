<?php

use yii\db\Migration;

class m160301_221028_create_item extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%item}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
            'content' => $this->text(),
            'category_id' => $this->integer()
        ], $tableOptions);
        $this->addForeignKey('fk_item_category', '{{%item}}', 'category_id', '{{%tree}}', 'id', 'CASCADE', 'CASCADE');
    
        $this->createTable('{{%item_file}}', [
            'id' => $this->primaryKey(),
            'item_id' => $this->integer()->notNull(),
            'file_id' => $this->integer()->notNull(),
            'type' => $this->smallInteger()->notNull()->defaultValue(1)
        ], $tableOptions);
        $this->addForeignKey('fk_item_file_item', '{{%item_file}}', 'item_id', '{{%item}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_item_file_file', '{{%item_file}}', 'file_id', '{{%uploaded_file}}', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->dropForeignKey('fk_item_file', '{{%item_file}}');
        $this->dropForeignKey('fk_item_category', '{{%item}}');

        $this->dropTable('{{%item_file}}');
        $this->dropTable('{{%item}}');
    }
}

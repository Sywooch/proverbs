<?php

use yii\db\Schema;
use yii\db\Migration;

class m151126_095009_add_board_table extends Migration
{
    public function up()
    {
        $tableOptions = null;

        if ($this->db->driverName === 'mysql') 
        {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%board}}', [
            'id' => $this->primaryKey(),
            'content' => $this->string(255)->notNull(),
            'posted_by' => $this->integer()->notNull(),
            'created_at' => $this->integer()->notNull(),
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%board}}');
    }
}

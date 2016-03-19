<?php

use yii\db\Schema;
use yii\db\Migration;

class m160319_163750_create_tuition_fee_table extends Migration
{
    public function up()
    {
        $tableOptions = null;

        if ($this->db->driverName === 'mysql') 
        {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        
        //CREATE STUDENTS TABLE
        $this->createTable('{{%tuition}}', [
                'id' => 'SMALLINT(3) AUTO_INCREMENT',
                'grade_level_id' => $this->smallInteger(3),
                'enrollment' => $this->double(),
                'admission' => $this->double(),
                'tuition_fee' => $this->double(),
                'misc_fee' => $this->double(),
                'ancillary' => $this->double(),
                'yearly' => $this->double(),
                'monthly' => $this->double(),
                'books' => $this->double(),

                'created_at' => $this->integer()->notNull(),
                'updated_at' => $this->integer()->notNull(),
                'PRIMARY KEY (id)'
            ], $tableOptions);

        $this->createIndex('fk_29_idx', '{{%tuition}}', 'grade_level_id');
        $this->addForeignKey('fk_29', '{{%tuition}}', 'grade_level_id', '{{%grade_level}}', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->dropForeignKey('fk_29','{{%tuition}}');
        $this->dropIndex('fk_29_idx','{{%tuition}}');

        $this->dropTable('{{%tuition}}');
    }
}

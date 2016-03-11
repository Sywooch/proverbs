<?php

use yii\db\Schema;
use yii\db\Migration;

class m160310_133223_create_learning_area_table extends Migration
{
    public function up()
    {
        $tableOptions = null;

        if ($this->db->driverName === 'mysql') 
        {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        
        //CREATE STUDENTS TABLE
        $this->createTable('{{%learning_area}}', [
                'grade_level_id' => $this->smallInteger(3),
                'subject_id'  => $this->smallInteger(3),
                'PRIMARY KEY (grade_level_id, subject_id)'
            ], $tableOptions);

        $this->createIndex('fk_27_idx', '{{%learning_area}}', 'grade_level_id');
        $this->addForeignKey('fk_27', '{{%learning_area}}', 'grade_level_id', '{{%grade_level}}', 'id', 'CASCADE', 'CASCADE');
        $this->createIndex('fk_28_idx', '{{%learning_area}}', 'subject_id');
        $this->addForeignKey('fk_28', '{{%learning_area}}', 'subject_id', '{{%subject}}', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->dropForeignKey('fk_27','{{%learning_area}}');
        $this->dropForeignKey('fk_28','{{%learning_area}}');
        $this->dropIndex('fk_27_idx','{{%learning_area}}');
        $this->dropIndex('fk_28_idx','{{%learning_area}}');
        $this->dropTable('{{%learning_area}}');
    }
}

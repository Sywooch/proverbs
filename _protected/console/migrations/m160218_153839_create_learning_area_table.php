<?php

use yii\db\Schema;
use yii\db\Migration;

class m160218_153839_create_learning_area_table extends Migration
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
                'id' => $this->smallInteger(3),
                'grade_level_id' => $this->smallInteger(3),
                'subject_id' => $this->smallInteger(3),
                'sequence'  => $this->smallInteger(1),
                'semester'  => $this->smallInteger(1),
                'revision'  => $this->smallInteger(1),
                'PRIMARY KEY (id, subject_id)'
            ], $tableOptions);

        $this->createIndex('fk_9_idx', '{{%learning_area}}', 'grade_level_id');
        $this->addForeignKey('fk_9', '{{%learning_area}}', 'grade_level_id', '{{%grade_level}}', 'id', 'CASCADE', 'CASCADE');
        $this->createIndex('fk_10_idx', '{{%learning_area}}', 'subject_id');
        $this->addForeignKey('fk_10', '{{%learning_area}}', 'subject_id', '{{%subject}}', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->dropForeignKey('fk_9','{{%learning_area}}');
        $this->dropForeignKey('fk_10','{{%learning_area}}');
        $this->dropIndex('fk_9_idx','{{%learning_area}}');
        $this->dropIndex('fk_10_idx','{{%learning_area}}');
        $this->dropTable('{{%learning_area}}');
    }
}

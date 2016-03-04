<?php

use yii\db\Schema;
use yii\db\Migration;

class m160304_022657_create_assigned_subject_table extends Migration
{
    public function up()
    {
        $tableOptions = null;

        if ($this->db->driverName === 'mysql') 
        {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        
        $this->createTable('{{%assigned}}', [
                'id' => 'BIGINT(20) AUTO_INCREMENT',
                'sy_id' => $this->bigInteger(20),
                'grade_level_id' => $this->smallInteger(3),
                'teacher_id' => $this->integer(11),
                'section_id' => $this->smallInteger(3),
                'subject_id' => $this->smallInteger(3),
                'PRIMARY KEY (id)'
            ], $tableOptions);
        
        $this->createIndex('fk_22_idx', '{{%assigned}}', 'sy_id');
        $this->createIndex('fk_23_idx', '{{%assigned}}', 'grade_level_id');
        $this->createIndex('fk_24_idx', '{{%assigned}}', 'teacher_id');
        $this->createIndex('fk_25_idx', '{{%assigned}}', 'section_id');
        $this->createIndex('fk_26_idx', '{{%assigned}}', 'subject_id');
        $this->addForeignKey('fk_22', '{{%assigned}}', 'sy_id', '{{%school_year}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_23', '{{%assigned}}', 'grade_level_id', '{{%grade_level}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_24', '{{%assigned}}', 'teacher_id', '{{%user}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_25', '{{%assigned}}', 'section_id', '{{%section}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_26', '{{%assigned}}', 'subject_id', '{{%subject}}', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->dropForeignKey('fk_22','{{%assigned}}');
        $this->dropForeignKey('fk_23','{{%assigned}}');
        $this->dropForeignKey('fk_24','{{%assigned}}');
        $this->dropForeignKey('fk_25','{{%assigned}}');
        $this->dropForeignKey('fk_26','{{%assigned}}');
        $this->dropIndex('fk_22_idx','{{%assigned}}');
        $this->dropIndex('fk_23_idx','{{%assigned}}');
        $this->dropIndex('fk_24_idx','{{%assigned}}');
        $this->dropIndex('fk_25_idx','{{%assigned}}');
        $this->dropIndex('fk_26_idx','{{%assigned}}');
        $this->dropTable('{{%assigned}}');
    }
}

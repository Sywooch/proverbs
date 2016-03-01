<?php

use yii\db\Schema;
use yii\db\Migration;

class m160218_155020_create_enrolled_table extends Migration
{
    public function up()
    {
        $tableOptions = null;

        if ($this->db->driverName === 'mysql') 
        {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        
        //CREATE STUDENTS TABLE
        $this->createTable('{{%enrolled}}', [
                'id' => 'BIGINT(20) AUTO_INCREMENT',
                'student_id' => $this->bigInteger(20),
                'grade_level_id' => $this->smallInteger(3),
                'enrollment_status'  => $this->smallInteger(1)->defaultValue(0),
                'sy_id' => $this->smallInteger(3),
                'section_id' => $this->smallInteger(3),
                'created_at' => $this->integer()->notNull(),
                'updated_at' => $this->integer()->notNull(),
                'PRIMARY KEY (id)'
            ], $tableOptions);

        $this->createIndex('fk_11_idx', '{{%enrolled}}', 'student_id');
        $this->createIndex('fk_12_idx', '{{%enrolled}}', 'grade_level_id');
        $this->createIndex('fk_sy_idx', '{{%enrolled}}', 'sy_id');
        $this->createIndex('fk_section_idx', '{{%enrolled}}', 'section_id');
        $this->addForeignKey('fk_11', '{{%enrolled}}', 'student_id', '{{%student}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_12', '{{%enrolled}}', 'grade_level_id', '{{%grade_level}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_sy', '{{%enrolled}}', 'sy_id', '{{%school_year}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_section', '{{%enrolled}}', 'section_id', '{{%section}}', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->dropForeignKey('fk_11','{{%enrolled}}');
        $this->dropForeignKey('fk_12','{{%enrolled}}');
        $this->dropForeignKey('fk_sy','{{%enrolled}}');
        $this->dropForeignKey('fk_section','{{%enrolled}}');
        $this->dropIndex('fk_11_idx','{{%enrolled}}');
        $this->dropIndex('fk_12_idx','{{%enrolled}}');
        $this->dropIndex('fk_sy_idx','{{%enrolled}}');
        $this->dropIndex('fk_section_idx','{{%enrolled}}');
        $this->dropTable('{{%enrolled}}');
    }
}

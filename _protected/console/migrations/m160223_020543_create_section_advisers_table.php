<?php

use yii\db\Schema;
use yii\db\Migration;

class m160223_020543_create_section_advisers_table extends Migration
{
    public function up()
    {
        $tableOptions = null;

        if ($this->db->driverName === 'mysql') 
        {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        
        $this->createTable('{{%advisory}}', [
                'id' => 'BIGINT(20) AUTO_INCREMENT',
                'section_id' => $this->smallInteger(3),
                'teacher_id' => $this->integer(11),
                'grade_level_id' => $this->smallInteger(3),
                'sy_id' => $this->bigInteger(20),
                'PRIMARY KEY (id)'
            ], $tableOptions);
        
        $this->createIndex('fk_18_idx', '{{%advisory}}', 'teacher_id');
        $this->createIndex('fk_19_idx', '{{%advisory}}', 'grade_level_id');
        $this->createIndex('fk_20_idx', '{{%advisory}}', 'sy_id');
        $this->createIndex('fk_21_idx', '{{%advisory}}', 'section_id');
        $this->addForeignKey('fk_18', '{{%advisory}}', 'teacher_id', '{{%user}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_19', '{{%advisory}}', 'grade_level_id', '{{%grade_level}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_20', '{{%advisory}}', 'sy_id', '{{%school_year}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_21', '{{%advisory}}', 'sy_id', '{{%section}}', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->dropForeignKey('fk_18','{{%advisory}}');
        $this->dropForeignKey('fk_19','{{%advisory}}');
        $this->dropForeignKey('fk_20','{{%advisory}}');
        $this->dropForeignKey('fk_21','{{%advisory}}');
        $this->dropIndex('fk_18_idx','{{%advisory}}');
        $this->dropIndex('fk_19_idx','{{%advisory}}');
        $this->dropIndex('fk_20_idx','{{%advisory}}');
        $this->dropIndex('fk_21_idx','{{%advisory}}');
        $this->dropTable('{{%advisory}}');
    }
}

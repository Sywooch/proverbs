<?php

use yii\db\Schema;
use yii\db\Migration;

class m160221_151044_create_grade_table extends Migration
{
    public function up()
    {
        $tableOptions = null;

        if ($this->db->driverName === 'mysql') 
        {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        
        //CREATE STUDENTS TABLE
        $this->createTable('{{%grade}}', [
                'id' => 'BIGINT(20) AUTO_INCREMENT',
                'enrolled_id' => $this->bigInteger(20),
                'grading_period' => $this->smallInteger(1),
                'core_value_1' => $this->smallInteger(1)->defaultValue(0)->notNull(),
                'core_value_2' => $this->smallInteger(1)->defaultValue(0)->notNull(),
                'core_value_3' => $this->smallInteger(1)->defaultValue(0)->notNull(),
                'core_value_4' => $this->smallInteger(1)->defaultValue(0)->notNull(),
                'subject_1' => $this->smallInteger(1)->defaultValue(0)->notNull(),
                'subject_2' => $this->smallInteger(1)->defaultValue(0)->notNull(),
                'subject_3' => $this->smallInteger(1)->defaultValue(0)->notNull(),
                'subject_4' => $this->smallInteger(1)->defaultValue(0)->notNull(),
                'subject_5' => $this->smallInteger(1)->defaultValue(0)->notNull(),
                'subject_6' => $this->smallInteger(1)->defaultValue(0)->notNull(),
                'subject_7' => $this->smallInteger(1)->defaultValue(0)->notNull(),
                'subject_8' => $this->smallInteger(1)->defaultValue(0)->notNull(),
                'subject_9' => $this->smallInteger(1)->defaultValue(0)->notNull(),
                'subject_10' => $this->smallInteger(1)->defaultValue(0)->notNull(),
                'PRIMARY KEY (id)'
            ], $tableOptions);
        
        $this->createIndex('fk_16_idx', '{{%grade}}', 'enrolled_id');
        $this->addForeignKey('fk_16', '{{%grade}}', 'enrolled_id', '{{%enrolled}}', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->dropForeignKey('fk_16','{{%grade}}');
        $this->dropIndex('fk_16_idx','{{%grade}}');
        $this->dropTable('{{%grade}}');
    }
}

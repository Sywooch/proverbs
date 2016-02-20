<?php

use yii\db\Schema;
use yii\db\Migration;

class m160218_155010_create_tuition_fee_table extends Migration
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
                'fee' => $this->float(),
                'sem' => $this->smallInteger(1)->defaultValue(0),
                'PRIMARY KEY (id)'
            ], $tableOptions);

        $this->createIndex('fk_14_idx', '{{%tuition}}', 'grade_level_id');
        $this->addForeignKey('fk_14', '{{%tuition}}', 'grade_level_id', '{{%grade_level}}', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->dropForeignKey('fk_14','{{%tuition}}');
        $this->dropIndex('fk_14_idx','{{%tuition}}');

        $this->dropTable('{{%tuition}}');
    }
}

<?php

use yii\db\Schema;
use yii\db\Migration;

class m160223_013503_create_sections_table extends Migration
{
    public function up()
    {
        $tableOptions = null;

        if ($this->db->driverName === 'mysql') 
        {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        
        //CREATE STUDENTS TABLE
        $this->createTable('{{%section}}', [
                'id' => 'SMALLINT(3) AUTO_INCREMENT',
                'section_name' => $this->string(20)->notNull(),
                'grade_level_id' => $this->smallInteger(3),
                'PRIMARY KEY (id)'
            ], $tableOptions);
        
        $this->createIndex('fk_17_idx', '{{%section}}', 'grade_level_id');
        $this->addForeignKey('fk_17', '{{%section}}', 'grade_level_id', '{{%grade_level}}', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->dropForeignKey('fk_17','{{%section}}');
        $this->dropIndex('fk_17_idx','{{%section}}');
        $this->dropTable('{{%section}}');
    }
}

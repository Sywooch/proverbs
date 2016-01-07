<?php

use yii\db\Schema;
use yii\db\Migration;

class m151226_044713_create_learning_area_table extends Migration
{
    public function up()
    {
        $tableOptions = null;

        if ($this->db->driverName === 'mysql') 
        {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        
        //CREATE SECTIONS TABLE
        $this->createTable('{{%learning_area}}', [
            'id' => 'SMALLINT(3) NOT NULL AUTO_INCREMENT',
            'grade_level_id' => $this->smallInt(3), //RELATES TO GRADE LEVEL TABLE 
            'PRIMARY KEY (id)'
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%learning_area}}');
    }
}

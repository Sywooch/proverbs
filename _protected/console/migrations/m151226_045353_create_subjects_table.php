<?php

use yii\db\Schema;
use yii\db\Migration;

class m151226_045353_create_subjects_table extends Migration
{
    public function up()
    {
        $tableOptions = null;

        if ($this->db->driverName === 'mysql') 
        {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        
        //CREATE STUDENTS TABLE
        $this->createTable('{{%subject}}', [
                'id' => $this->smallInteger(3),
                'subject_name'  => $this->string(45),
                'PRIMARY KEY (id)'
            ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%subject}}');
    }
}
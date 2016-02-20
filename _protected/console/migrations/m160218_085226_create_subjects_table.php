<?php

use yii\db\Schema;
use yii\db\Migration;

class m160218_085226_create_subjects_table extends Migration
{
    public function up()
    {
        $tableOptions = null;

        if ($this->db->driverName === 'mysql') 
        {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB ';
        }
        
        //CREATE STUDENTS TABLE
        $this->createTable('{{%subject}}', [
                'id' => 'SMALLINT(3) AUTO_INCREMENT PRIMARY KEY',
                'subject_name'  => $this->string(45),
            ], $tableOptions);

    }

    public function down()
    {
        $this->dropTable('{{%subject}}');
    }
}
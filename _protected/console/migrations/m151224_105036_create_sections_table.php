<?php

use yii\db\Schema;
use yii\db\Migration;

class m151224_105036_create_sections_table extends Migration
{
    public function up()
    {
        $tableOptions = null;

        if ($this->db->driverName === 'mysql') 
        {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        
        //CREATE SECTIONS TABLE
        $this->createTable('{{%section}}', [
            'id' => 'SMALLINT(3) NOT NULL AUTO_INCREMENT',
            'teacher_id' => $this->integer(), //RELATES TO USER TABLE
            'name' => $this->string(16),
            'PRIMARY KEY (id)'
            
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%section}}');
    }
}

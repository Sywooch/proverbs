<?php

use yii\db\Schema;
use yii\db\Migration;

class m160220_134511_create_school_year_table extends Migration
{
    public function up()
    {
        $tableOptions = null;

        if ($this->db->driverName === 'mysql') 
        {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        
        $this->createTable('{{%school_year}}', [
                'id' => 'BIGINT(20) AUTO_INCREMENT',
                'sy' => $this->string(10),
                'PRIMARY KEY (id)'
            ], $tableOptions);

    }

    public function down()
    {
        $this->dropTable('{{%school_year}}');
    }
}

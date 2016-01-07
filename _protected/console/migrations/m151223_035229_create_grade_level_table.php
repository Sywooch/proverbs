<?php

use yii\db\Schema;
use yii\db\Migration;

class m151223_035229_create_grade_level_table extends Migration
{
    public function up()
    {
        $tableOptions = null;

        if ($this->db->driverName === 'mysql') 
        {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%grade_level}}', [
        'id' => 'SMALLINT(3) NOT NULL AUTO_INCREMENT',
        'name' => $this->string(45),
        'description' => $this->string(45),
        'PRIMARY KEY (id)'
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%grade_level}}');
    }
}

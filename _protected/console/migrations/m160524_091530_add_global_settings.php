<?php

use yii\db\Migration;

class m160524_091530_add_global_settings extends Migration
{
    public function up()
    {
        $tableOptions = null;

        if ($this->db->driverName === 'mysql') 
        {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%global_settings}}', [
            'data_access_request' => $this->smallInteger(1),
            'maintenance_mode' => $this->smallInteger(1),
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%global_settings}}');
    }
}

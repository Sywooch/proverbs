<?php

use yii\db\Migration;

class m160524_071647_add_request_table extends Migration
{
    public function up()
    {
        $tableOptions = null;

        if ($this->db->driverName === 'mysql') 
        {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%request}}', [
            'id' => $this->primaryKey(),
            'student_id' => $this->bigInteger(20),
            'request_status' => $this->smallInteger(1),
            'created_at' => $this->integer(11),
            'updated_at' => $this->integer(11),
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%request}}');
    }
}

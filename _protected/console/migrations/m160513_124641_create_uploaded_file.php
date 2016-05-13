<?php

use yii\db\Migration;

/**
 * Handles the creation for table `uploaded_file`.
 */
class m160513_124641_create_uploaded_file extends Migration
{
    public function up()
    {
        $tableOptions = null;

        if ($this->db->driverName === 'mysql') 
        {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%uploaded_file}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(64),
            'filename' => $this->string(255),
            'size' => $this->integer(),
            'type' => $this->string(32),
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%uploaded_file}}');
    }
}

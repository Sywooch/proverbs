<?php

use yii\db\Schema;
use yii\db\Migration;

class m151223_115452_create_entrance_exam_table extends Migration
{
    public function up()
    {
        $tableOptions = null;

        if ($this->db->driverName === 'mysql') 
        {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%entrance_exam}}', [
            'id' => $this->bigPrimaryKey(),
            'applicant_id' => $this->bigInteger(), //RELATES TO STUDENT ID
            'english' => $this->smallInteger(3)->notNull(),
            'reading_skills' => $this->smallInteger(3)->notNull(),
            'science' => $this->smallInteger(3)->notNull(),
            'comprehension' => $this->smallInteger(3)->notNull(),
            'remarks' => $this->string(255),
            'recommendations' => $this->string(255),

            //SYSTEM
            'created_at' => $this->integer(),
            'updated_at' => $this->integer()
        ], $tableOptions);

    }

    public function down()
    {
        $this->dropTable('{{%entrance_exam}}');
    }
}

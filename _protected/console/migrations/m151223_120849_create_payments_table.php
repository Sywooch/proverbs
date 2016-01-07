<?php

use yii\db\Schema;
use yii\db\Migration;

class m151223_120849_create_payments_table extends Migration
{
    public function up()
    {
        $tableOptions = null;

        if ($this->db->driverName === 'mysql') 
        {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        
        //CREATE STUDENTS TABLE
        $this->createTable('{{%payment}}', [
                'id' => $this->bigPrimaryKey(),
                'student_id' => $this->bigInteger(),
                'paid_amount' => $this->float(),
                'type' => $this->boolean(), //0:CASH 1:CARD
                'payment_date' => $this->datetime(),

                'created_at' => $this->integer(),
                'updated_at' => $this->integer(),
            ], $tableOptions);       
    }

    public function down()
    {
        $this->dropTable('{{%payment}}');
    }
}

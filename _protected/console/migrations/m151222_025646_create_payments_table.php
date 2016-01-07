<?php

use yii\db\Schema;
use yii\db\Migration;

class m151222_025646_create_payments_table extends Migration
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

                'created_at' => $this->integer()->notNull(),
                'updated_at' => $this->integer()->notNull(),
            ], $tableOptions);

        $this->createIndex('fk_8_idx', '{{%payment}}', 'student_id');
        $this->addForeignKey('fk_8', '{{%payment}}', 'student_id', '{{%student}}', 'id', 'CASCADE', 'CASCADE');        
    }

    public function down()
    {
        $this->dropTable('{{%payment}}');
    }
}

<?php

use yii\db\Schema;
use yii\db\Migration;

class m160326_163122_create_sibling_discounts_table extends Migration
{
    public function up()
    {
        $tableOptions = null;

        if ($this->db->driverName === 'mysql') 
        {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        
        $this->createTable('{{%sibling_discount}}', [
                'id' => 'SMALLINT(1) AUTO_INCREMENT',
                'percentage_value' => $this->smallInteger(1),

                'PRIMARY KEY (id)'
            ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%sibling_discount}}');
    }
}

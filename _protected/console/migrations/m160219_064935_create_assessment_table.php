<?php

use yii\db\Schema;
use yii\db\Migration;

class m160219_064935_create_assessment_table extends Migration
{
    public function up()
    {
        $tableOptions = null;

        if ($this->db->driverName === 'mysql') 
        {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        
        $this->createTable('{{%assessment}}', [
                'id' => 'BIGINT(20) AUTO_INCREMENT',
                'enrolled_id' => $this->bigInteger(20),
                'tuition_id' => $this->smallInteger(3),
                'created_at' => $this->integer()->notNull(),
                'updated_at' => $this->integer()->notNull(),
                'PRIMARY KEY (id)'
            ], $tableOptions);

        $this->createIndex('fk_13_idx', '{{%assessment}}', 'enrolled_id');
        $this->addForeignKey('fk_13', '{{%assessment}}', 'enrolled_id', '{{%enrolled}}', 'id', 'CASCADE', 'CASCADE');
        $this->createIndex('fk_13b_idx', '{{%assessment}}', 'tuition_id');
        $this->addForeignKey('fk_13b', '{{%assessment}}', 'tuition_id', '{{%tuition}}', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->dropForeignKey('fk_13','{{%assessment}}');
        $this->dropIndex('fk_13_idx','{{%assessment}}');
        $this->dropForeignKey('fk_13b','{{%assessment}}');
        $this->dropIndex('fk_13b_idx','{{%assessment}}');
        $this->dropTable('{{%assessment}}');
    }
}

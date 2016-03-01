<?php

use yii\db\Schema;
use yii\db\Migration;

class m151223_120909_create_relations_1_table extends Migration
{
    public function up()
    {
        $this->createIndex('fk_5_idx', '{{%entrance_exam}}', 'applicant_id');
        $this->createIndex('fk_6_idx', '{{%student}}', 'grade_level_id');
        $this->createIndex('fk_7_idx', '{{%payment}}', 'student_id');

        $this->addForeignKey('fk_5', '{{%entrance_exam}}', 'applicant_id', '{{%student}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_6', '{{%student}}', 'grade_level_id', '{{%grade_level}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_7', '{{%payment}}', 'student_id', '{{%student}}', 'id', 'CASCADE', 'CASCADE'); 
    }

    public function down()
    {
        $this->dropForeignKey('fk_5','{{%entrance_exam}}');
        $this->dropForeignKey('fk_6','{{%student}}');
        $this->dropForeignKey('fk_7','{{%payment}}');
    }
}

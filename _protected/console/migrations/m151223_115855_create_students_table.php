<?php

use yii\db\Schema;
use yii\db\Migration;

class m151223_115855_create_students_table extends Migration
{
    public function up()
    {
        $tableOptions = null;

        if ($this->db->driverName === 'mysql') 
        {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        //CREATE STUDENTS TABLE
        $this->createTable('{{%student}}', [
            'id' => $this->bigInteger(20),

            //STUDENT PERSONAL INFO
            'first_name' => $this->string(45)->notNull(),
            'middle_name' => $this->string(45)->notNull(),
            'last_name' => $this->string(45)->notNull(),
            'nickname' => $this->string(45),
            'gender' => $this->string(7)->notNull(),
            'birth_date' => $this->date()->notNull(),
            'religion' => $this->string(45)->notNull(),
            'citizenship' => $this->string(45)->notNull(),
            'address' => $this->string(255)->notNull(),
            'zip_code' => $this->smallInteger()->notNull(),
            'phone' => $this->integer(7),
            'mobile' => $this->bigInteger(11),
            
            //PARENT
            'fathers_name' => $this->string(45)->notNull(),
            'fathers_occupation' => $this->string(45),
            'fathers_employer' => $this->string(45),
            'fathers_citizenship' => $this->string(45)->notNull(),
            'fathers_religion' => $this->string(45)->notNull(),
            'fathers_email' => $this->string(128),
            'fathers_phone' => $this->integer(7),
            'fathers_mobile' => $this->bigInteger(11),
            'father_is' => $this->boolean(),
            
            'mothers_name' => $this->string(45)->notNull(),
            'mothers_occupation' => $this->string(45),
            'mothers_employer' => $this->string(45),
            'mothers_citizenship' => $this->string(45)->notNull(),
            'mothers_religion' => $this->string(45)->notNull(),
            'mothers_email' => $this->string(128),
            'mothers_phone' => $this->integer(7),
            'mothers_mobile' => $this->bigInteger(11),
            'mother_is' => $this->boolean(),
            'parents_are' => $this->boolean(), //0:Together 1:Separated 2:Widowed 3:Single 4:Marriage Anulled

            //GUARDIAN
            'guardians_name' => $this->string(45)->notNull(),
            'guardians_profile_image' => $this->string(255),
            'guardians_address' => $this->string(255)->notNull(),
            'guardians_relation_to_student' => $this->string(45)->notNull(),
            'guardians_occupation' => $this->string(45),
            'guardians_employer' => $this->string(45),
            'guardians_phone' => $this->integer(7),
            'guardians_mobile' => $this->bigInteger(11),
            'student_is_living_with' => $this->boolean(), //0:Both Parents 1:Father 2:Mother 3:Guardian
            'student_has_sibling_enrolled' => $this->boolean(),

            //REQUIREMENTS
            'student_photo' => $this->boolean()->notNull(),
            'guardians_photo' => $this->boolean()->notNull(),
            'report_card' => $this->boolean()->notNull(),
            'birth_certificate' => $this->boolean()->notNull(),
            'good_moral' => $this->boolean()->notNull(),

            //RELATIONS
            'grade_level_id' => $this->smallInteger(3), //RELATES TO GRADE LEVEL TABLE

            //PREVIOUS SCHOOL
            'previous_school_name' => $this->string(128),
            'previous_school_description' => $this->string(45),
            'previous_school_address' => $this->string(128),
            'previous_school_phone' => $this->integer(),
            'previous_school_mobile' => $this->integer(),
            'previous_school_grade_level' => $this->smallInteger(),
            'previous_school_average_grade' => $this->smallInteger(),
            'previous_school_teacher_in_charge' => $this->string(45),
            'previous_school_principal' => $this->string(45),
            'from_school_year' => $this->date(),
            'to_school_year' => $this->date(),

            //INCOMING STUDENT
            'status' => $this->smallInteger(1)->notNull(), // 0:INACTIVE 1:ACTIVE 2: APPLICANT (DEFAULT)
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'PRIMARY KEY (id)'

        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%student}}');
    }   
}

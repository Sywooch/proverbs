<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "parents".
 *
 * @property string $id
 * @property string $student_id
 * @property string $fathers_name
 * @property string $fathers_occupation
 * @property string $fathers_employer
 * @property string $fathers_citizenship
 * @property string $fathers_religion
 * @property string $fathers_email
 * @property integer $fathers_mobile
 * @property integer $fathers_phone
 * @property integer $father_is_deceased
 * @property string $mothers_name
 * @property string $mothers_occupation
 * @property string $mothers_employer
 * @property string $mothers_citizenship
 * @property string $mothers_religion
 * @property string $mothers_email
 * @property integer $mothers_mobile
 * @property integer $mothers_phone
 * @property integer $mother_is_deceased
 * @property integer $parents_are
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Student $student
 * @property Student[] $students
 */
class Parents extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'parents';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['student_id', 'fathers_mobile', 'fathers_phone', 'father_is_deceased', 'mothers_mobile', 'mothers_phone', 'mother_is_deceased', 'parents_are', 'created_at', 'updated_at'], 'integer'],
            [['fathers_name', 'fathers_occupation', 'fathers_citizenship', 'fathers_religion', 'father_is_deceased', 'mothers_name', 'mothers_occupation', 'mothers_citizenship', 'mothers_religion', 'mother_is_deceased', 'created_at', 'updated_at'], 'required'],
            [['fathers_name', 'fathers_occupation', 'fathers_employer', 'fathers_citizenship', 'fathers_religion', 'mothers_name', 'mothers_occupation', 'mothers_employer', 'mothers_citizenship', 'mothers_religion'], 'string', 'max' => 45],
            [['fathers_email', 'mothers_email'], 'string', 'max' => 128]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'student_id' => 'Student ID',
            'fathers_name' => 'Fathers Name',
            'fathers_occupation' => 'Fathers Occupation',
            'fathers_employer' => 'Fathers Employer',
            'fathers_citizenship' => 'Fathers Citizenship',
            'fathers_religion' => 'Fathers Religion',
            'fathers_email' => 'Fathers Email',
            'fathers_mobile' => 'Fathers Mobile',
            'fathers_phone' => 'Fathers Phone',
            'father_is_deceased' => 'Father Is Deceased',
            'mothers_name' => 'Mothers Name',
            'mothers_occupation' => 'Mothers Occupation',
            'mothers_employer' => 'Mothers Employer',
            'mothers_citizenship' => 'Mothers Citizenship',
            'mothers_religion' => 'Mothers Religion',
            'mothers_email' => 'Mothers Email',
            'mothers_mobile' => 'Mothers Mobile',
            'mothers_phone' => 'Mothers Phone',
            'mother_is_deceased' => 'Mother Is Deceased',
            'parents_are' => 'Parents Are',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudent()
    {
        return $this->hasOne(Student::className(), ['id' => 'student_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudents()
    {
        return $this->hasMany(Student::className(), ['parent_id' => 'id']);
    }
}

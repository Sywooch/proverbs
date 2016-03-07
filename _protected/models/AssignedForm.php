<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "assigned".
 *
 * @property string $id
 * @property string $sy_id
 * @property integer $grade_level_id
 * @property integer $teacher_id
 * @property integer $section_id
 * @property integer $subject_id
 *
 * @property SchoolYear $sy
 * @property GradeLevel $gradeLevel
 * @property User $teacher
 * @property Section $section
 * @property Subject $subject
 */
class AssignedForm extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'assigned';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sy_id', 'grade_level_id', 'teacher_id', 'section_id', 'subject_id'], 'integer'],
            [['sy_id', 'grade_level_id', 'teacher_id', 'section_id', 'subject_id'], 'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sy_id' => 'School Year',
            'grade_level_id' => 'Grade Level',
            'teacher_id' => 'Teacher',
            'section_id' => 'Section',
            'subject_id' => 'Subject',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSy()
    {
        return $this->hasOne(SchoolYear::className(), ['id' => 'sy_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGradeLevel()
    {
        return $this->hasOne(GradeLevel::className(), ['id' => 'grade_level_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTeacher()
    {
        return $this->hasOne(User::className(), ['id' => 'teacher_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSection()
    {
        return $this->hasOne(Section::className(), ['id' => 'section_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubject()
    {
        return $this->hasOne(Subject::className(), ['id' => 'subject_id']);
    }
}
<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "learning_area".
 *
 * @property integer $id
 * @property integer $grade_level_id
 * @property integer $subject_id
 * @property integer $sequence
 * @property integer $semester
 * @property integer $revision
 *
 * @property Subject $subject
 * @property GradeLevel $gradeLevel
 */
class LearningArea extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'learning_area';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'subject_id'], 'required'],
            [['id', 'grade_level_id', 'subject_id', 'sequence', 'semester', 'revision'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'grade_level_id' => 'Grade Level ID',
            'subject_id' => 'Subject ID',
            'subject.subject_name' => 'Subject',
            'sequence' => 'Sequence',
            'semester' => 'Semester',
            'revision' => 'Revision',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubject()
    {
        return $this->hasOne(Subject::className(), ['id' => 'subject_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGradeLevel()
    {
        return $this->hasOne(GradeLevel::className(), ['id' => 'grade_level_id']);
    }
}

<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "grade".
 *
 * @property string $id
 * @property integer $grade_protection
 * @property string $enrolled_id
 * @property integer $grading_period
 * @property integer $core_value_1
 * @property integer $core_value_2
 * @property integer $core_value_3
 * @property integer $core_value_4
 * @property integer $subject_1
 * @property integer $subject_2
 * @property integer $subject_3
 * @property integer $subject_4
 * @property integer $subject_5
 * @property integer $subject_6
 * @property integer $subject_7
 * @property integer $subject_8
 * @property integer $subject_9
 * @property integer $subject_10
 *
 * @property Enrolled $enrolled
 */
class GradeElevenFirstSemForm extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'grade';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['grade_protection', 'enrolled_id', 'grading_period', 'core_value_1', 'core_value_2', 'core_value_3', 'core_value_4', 'subject_1', 'subject_2', 'subject_3', 'subject_4', 'subject_5', 'subject_6', 'subject_7', 'subject_8', 'subject_9', 'subject_10'], 'integer'],
            [['enrolled_id','grading_period'], 'required']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'grade_protection' => 'Grade Protection',
            'enrolled_id' => 'Enrolled ID',
            'grading_period' => 'Grading Period',
            'core_value_1' => 'Makadiyos',
            'core_value_2' => 'Makatao',
            'core_value_3' => 'Makakalikasan',
            'core_value_4' => 'Makabansa',
            'subject_1' => 'Oral Communication',
            'subject_2' => 'Organization and Management',
            'subject_3' => 'General Mathematics',
            'subject_4' => 'Komunikasyon at pananaliksik',
            'subject_5' => 'Entreprenuership',
            'subject_6' => 'PE and Health',
            'subject_7' => 'Animation',
            'subject_8' => 'Computer Programming',
            'subject_9' => 'Bread and Pastry Production',
            'subject_10' => 'Creative Industries I: Arts and Design',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEnrolled()
    {
        return $this->hasOne(EnrolledForm::className(), ['id' => 'enrolled_id']);
    }
}

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
class GradeElevenSecondSemForm extends \yii\db\ActiveRecord
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
            'core_value_1' => 'Core Value 1',
            'core_value_2' => 'Core Value 2',
            'core_value_3' => 'Core Value 3',
            'core_value_4' => 'Core Value 4',
            'subject_1' => 'Reading and Writing Skills',
            'subject_2' => 'Applied Economics',
            'subject_3' => 'Statistics and Probability',
            'subject_4' => 'Pagbasa at Pagsusuri ng Ibat\'t ibang Teksto',
            'subject_5' => 'Introduction to Philisophy of Human Person',
            'subject_6' => 'Pagsulat sa Filipino',
            'subject_7' => 'Animation',
            'subject_8' => 'Computer Programming',
            'subject_9' => 'Bread and Pastry',
            'subject_10' => 'Creative Industries II: Performing Arts',
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

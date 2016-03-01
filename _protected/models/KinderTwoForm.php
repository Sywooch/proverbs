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
 *
 * @property Enrolled $enrolled
 */
class KinderTwoForm extends \yii\db\ActiveRecord
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
            [['grade_protection', 'enrolled_id', 'grading_period', 'core_value_1', 'core_value_2', 'core_value_3', 'core_value_4', 'subject_1', 'subject_2', 'subject_3', 'subject_4', 'subject_5', 'subject_6'], 'integer'],
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
            'core_value_1' => 'Makdiyos',
            'core_value_2' => 'Makatao',
            'core_value_3' => 'Makakalikasan',
            'core_value_4' => 'Makabansa',
            'subject_1' => 'Reading',
            'subject_2' => 'Math',
            'subject_3' => 'English',
            'subject_4' => 'Science',
            'subject_5' => 'Writing',
            'subject_6' => 'Following God',
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

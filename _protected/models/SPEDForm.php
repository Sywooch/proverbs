<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "grade".
 *
 * @property string $id
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
class SPEDForm extends \yii\db\ActiveRecord
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
            [['enrolled_id', 'grading_period', 'core_value_1', 'core_value_2', 'core_value_3', 'core_value_4', 'subject_1', 'subject_2', 'subject_3', 'subject_4', 'subject_5', 'subject_6', 'subject_7', 'subject_8', 'subject_9', 'subject_10'], 'integer'],
            [['grading_period'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'enrolled_id' => 'Enrolled ID',
            'grading_period' => 'Grading Period',
            'core_value_1' => 'Core Value 1',
            'core_value_2' => 'Core Value 2',
            'core_value_3' => 'Core Value 3',
            'core_value_4' => 'Core Value 4',
            'subject_1' => 'Subject 1',
            'subject_2' => 'Subject 2',
            'subject_3' => 'Subject 3',
            'subject_4' => 'Subject 4',
            'subject_5' => 'Subject 5',
            'subject_6' => 'Subject 6',
            'subject_7' => 'Subject 7',
            'subject_8' => 'Subject 8',
            'subject_9' => 'Subject 9',
            'subject_10' => 'Subject 10',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEnrolled()
    {
        return $this->hasOne(Enrolled::className(), ['id' => 'enrolled_id']);
    }
}

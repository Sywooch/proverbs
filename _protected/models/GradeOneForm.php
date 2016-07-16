<?php

namespace app\models;

use Yii;
use app\models\EnrolledForm;
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
 *
 * @property Enrolled $enrolled
 */
class GradeOneForm extends \yii\db\ActiveRecord
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
            [['grade_protection', 'enrolled_id', 'grading_period', 'core_value_1', 'core_value_2', 'core_value_3', 'core_value_4', 'subject_1', 'subject_2', 'subject_3', 'subject_4', 'subject_5', 'subject_6', 'subject_7', 'subject_8'], 'integer'],
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
            'subject_1' => 'English',
            'subject_2' => 'Math',
            'subject_3' => 'Science',
            'subject_4' => 'Civics',
            'subject_5' => 'Christian Education',
            'subject_6' => 'MTB',
            'subject_7' => 'MAPEH',
            'subject_8' => 'Filipino',
        ];
    }

    public function beforeSave($insert)
    {
        if(parent::beforeSave($insert)){
            if($this->isNewRecord){
                $this->core_value_1 = 0;
                $this->core_value_2 = 0;
                $this->core_value_3 = 0;
                $this->core_value_4 = 0;
                $this->subject_1 = 0;
                $this->subject_2 = 0;
                $this->subject_3 = 0;
                $this->subject_4 = 0;
                $this->subject_5 = 0;
                $this->subject_6 = 0;
                $this->subject_7 = 0;
                $this->subject_8 = 0;
            }else {

            }
            return true;
        } else {
            return false;
        }
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEnrolled()
    {
        return $this->hasOne(EnrolledForm::className(), ['id' => 'enrolled_id']);
    }
}

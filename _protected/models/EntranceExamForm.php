<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;
use app\models\GradeLevel;
use app\models\StudentForm;

/**
 * This is the model class for table "entrance_exam".
 *
 * @property string $id
 * @property string $applicant_id
 * @property integer $english
 * @property integer $reading_skills
 * @property integer $science
 * @property integer $comprehension
 * @property string $remarks
 * @property string $recommendations
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Student $applicant
 */
class EntranceExamForm extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'entrance_exam';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['applicant_id', 'english', 'reading_skills', 'science', 'comprehension', 'created_at', 'updated_at'], 'integer'],
            [['english', 'reading_skills', 'science', 'comprehension'], 'required'],
            [['applicant.first_name','applicant.middle_name','applicant.last_name', 'remarks', 'recommendations'], 'string', 'max' => 255],
            [['applicant_id'], 'exist', 'skipOnError' => true, 'targetClass' => StudentForm::className(), 'targetAttribute' => ['applicant_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'applicant_id' => 'Applicant ID',
            'applicant.first_name' => 'First Name',
            'applicant.middle_name' => 'Middle Name',
            'applicant.last_name' => 'Last Name',
            'applicant.gradeLevel.name' => 'Grade Level',
            'english' => 'English',
            'reading_skills' => 'Reading Skills',
            'science' => 'Science',
            'comprehension' => 'Comprehension',
            'remarks' => 'Remarks',
            'recommendations' => 'Recommendations',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }


    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
            ],
        ];
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getApplicant()
    {
        return $this->hasOne(StudentForm::className(), ['id' => 'applicant_id']);
    }
    
    public function getApplicantFirstName($id)
    {
        $student = $this->hasOne(StudentForm::className(), ['id' => 'applicant_id']);
        
        return $student['first_name'];
    }

    public function getApplicantMiddleName($id)
    {
        $student = $this->hasOne(StudentForm::className(), ['id' => 'applicant_id']);
        
        return $student['middle_name'];
    }

    public function getApplicantLastName($id)
    {
        $student = $this->hasOne(StudentForm::className(), ['id' => 'applicant_id']);
        
        return $student['last_name'];
    }

    public function getUpdatedAt($data) {        

        return \Carbon\Carbon::createFromTimestamp($data, 'Asia/Manila')->diffForHumans();
    }

    public function getGradeLevelName($id){
        $level = GradeLevel::findOne($id);

        return $level['name'];
    }

}

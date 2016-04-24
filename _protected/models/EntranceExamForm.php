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
    const N = null;
    const L1 = 1;
    const L2 = 2;
    const L3 = 3;
    const L10 = 10;
    const L20 = 20;
    const L30 = 30;
    const L40 = 40;
    const L50 = 50;
    const L60 = 60;
    const L70 = 70;
    const L80 = 80;
    const L90 = 90;
    const L100 = 100;
    const L110 = 110;
    const L111 = 111;
    const L120 = 120;
    const L121 = 121;
    
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
            [['remarks', 'recommendations'], 'string', 'max' => 255],
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


    public function getLevelList()
    {
        $levelArray = [
            self::N => null,
            self::L1 => 'Nursery',
            self::L2 => 'Kinder 1',
            self::L3 => 'Kinder 2',
            self::L10 => 'Grade 1',
            self::L20 => 'Grade 2',
            self::L30 => 'Grade 3',
            self::L40 => 'Grade 4',
            self::L50 => 'Grade 5',
            self::L60 => 'Grade 6',
            self::L70 => 'Grade 7',
            self::L80 => 'Grade 8',
            self::L90 => 'Grade 9',
            self::L100 => 'Grade 10',
            self::L110 => 'Grade 11 1st Sem',
            self::L111 => 'Grade 11 2nd Sem',
            self::L120 => 'Grade 12 1st Sem',
            self::L121 => 'Grade 12 2nd Sem',
        ];
        
        return $levelArray;
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


    public function getGradeLevel()
    {
        return $this->hasOne(GradeLevel::className(), ['id' => 'grade_level_id']);
    }

}

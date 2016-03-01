<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\models\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use app\models\SchoolYear;
/**
 * This is the model class for table "enrolled".
 *
 * @property string $id
 * @property string $student_id
 * @property integer $grade_level_id
 * @property integer $status
 * @property integer $total_tuition
 * @property integer $balance
 * @property integer $from_school_year
 * @property integer $to_school_year
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Student $student
 * @property GradeLevel $gradeLevel
 */
class EnrolledForm extends \yii\db\ActiveRecord
{
    const STATUS_PENDING = 0;
    const STATUS_ENROLLED = 1;
    const L0 = 0;
    const L1 = 1;
    const L2 = 2;
    const L3 = 3;
    const L4 = 4;
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
        return 'enrolled';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['enrollment_status', 'created_at', 'updated_at', 'student_id', 'grade_level_id', 'section_id'], 'integer'],
            [['gradeLevel', 'student', 'student_id', 'sy_id', 'sy', 'grade_level_id'],'safe'],
        ];
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    \yii\db\ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    \yii\db\ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
            ],
        ];
    }


    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if($this->isNewRecord){
                $this->created_at = time();
                $this->updated_at = time();
            } else {
                $this->touch('updated_at');
            }
            return true;
        } else {
            return false;
        }
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'student_id' => 'Student ID',
            'student' => 'Student',
            'student.last_name' => 'Last Name',
            'student.first_name' => 'First Name',
            'student.middle_name' => 'Middle Name',
            'gradeLevel' => 'Grade Level',
            'grade_level_id' => 'Grade Level',
            'enrollment_status' => 'Enrollment Status',
            'sy_id' => 'School Year',
            'sy.sy' => 'School Year',
            'section_id' => 'Section',
            'section.section_name' => 'Section',
            'created_at' => 'Date Created',
            'updated_at' => 'Last Updated',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudent()
    {
        return $this->hasOne(StudentForm::className(), ['id' => 'student_id']);
    }

    public function getGradeLevel()
    {
        return $this->hasOne(GradeLevel::className(), ['id' => 'grade_level_id']);
    }

   public function getSection() 
   { 
       return $this->hasOne(Section::className(), ['id' => 'section_id']); 
   }
   
    public function getSy()
    {
        return $this->hasOne(SchoolYear::className(), ['id' => 'sy_id']);
    }

    public function getSyItem()
    {
        return $this->hasOne(SchoolYear::className(), ['sy_id' => 'id']);
    }

    public function getGradeLevelName()
    {
        return $this->hasOne(GradeLevel::className(), ['id' => 'grade_level_id']);
    }

    public function getEnrollmentStatus($data)
    {
        if($data === 1){
            return 'Enrolled';
        } else {
            return 'Pending';
        }
    }

    public function getStatusList()
    {
        $statusArray = [
            self::STATUS_PENDING => 'Pending',
            self::STATUS_ENROLLED => 'Enrolled',
        ];
        

        return $statusArray;
    }

    public function getLevelList()
    {
        $levelArray = [
            self::L0 => 'Not Applicable',
            self::L1 => 'Nursery',
            self::L2 => 'Kinder 1',
            self::L3 => 'Kinder 2',
            self::L4 => 'SPED',
            self::L10 => 'Grade 1',
            self::L20 => 'Grade 2',
            self::L30 => 'Grade 3',
            self::L40 => 'Grade 4',
            self::L50 => 'Grade 5',
            self::L60 => 'Grade 6',
            self::L70 => 'Grade 7',
            self::L80 => 'Grade 8',
            self::L90 => 'Grade 9',
            self::L10 => 'Grade 10',
            self::L111 => 'Grade 11 1st Semester',
            self::L110 => 'Grade 11 2nd Semester',
            self::L120 => 'Grade 12 1st Semester',
            self::L121 => 'Grade 12 2nd Semester',
        ];
        
        return $levelArray;
    }

    public function getStatusName($status = null)
    {
        $status = (empty($status)) ? $this->enrollment_status : $status ;

        if ($status === self::STATUS_ENROLLED)
        {
            return "Enrolled";
        }
        else
        {
            return "Pending";
        }
    }

    public function getLevelName($grade_level = null)
    {
        $grade_level = (empty($grade_level)) ? $this->grade_level_id : $grade_level ;

        if ($grade_level === self::L121){
            return "Grade 12 2nd Semester";
        } elseif($grade_level === self::L121){
            return "Grade 12 1st Semester";
        } elseif($grade_level === self::L111){
            return "Grade 11 2nd Semester";
        } elseif($grade_level === self::L110){
            return "Grade 11 1st Semester";
        } elseif($grade_level === self::L100){
            return "Grade 10";
        } elseif($grade_level === self::L90){
            return "Grade 9";
        } elseif($grade_level === self::L80){
            return "Grade 8";
        } elseif($grade_level === self::L70){
            return "Grade 7";
        } elseif($grade_level === self::L60){
            return "Grade 6";
        } elseif($grade_level === self::L50){
            return "Grade 5";
        } elseif($grade_level === self::L40){
            return "Grade 4";
        } elseif($grade_level === self::L30){
            return "Grade 3";
        } elseif($grade_level === self::L20){
            return "Grade 2";
        } elseif($grade_level === self::L10){
            return "Grade 1";
        } elseif($grade_level === self::L4){
            return "SPED";
        } elseif($grade_level === self::L3){
            return "Kinder 2";
        } elseif($grade_level === self::L2){
            return "Kinder 1";
        } elseif($grade_level === self::L1){
            return "Nursery";
        } elseif($grade_level === self::L0){
            return "Not Applicable";
        }
    }

    public function getCreatedAt($data) {
        return \Carbon\Carbon::createFromTimestamp($data, 'Asia/Manila')->toFormattedDateString();
    }

    public function getUpdatedAt($data) {        

        return \Carbon\Carbon::createFromTimestamp($data, 'Asia/Manila')->diffForHumans();
    }
}

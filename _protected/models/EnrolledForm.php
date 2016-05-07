<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\models\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use app\models\SchoolYear;
use app\models\AssessmentForm;
use app\models\Tuition;
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
    const STATUS_NULL = null;
    const STATUS_PENDING = 1;
    const STATUS_ENROLLED = 0;
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
        return 'enrolled';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['student_id', 'grade_level_id', 'sy_id', 'section_id'],'required'],
            [['enrollment_status', 'created_at', 'updated_at', 'student_id', 'grade_level_id', 'section_id'], 'integer'],
            [['gradeLevel', 'student', 'student_id', 'sy_id', 'sy', 'grade_level_id'],'safe']
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

    public function afterSave($insert, $changedAttributes)
    {
        if($insert){

            $tuition = Tuition::find()->where(['grade_level_id' => $this->grade_level_id])->orderBy(['id' => SORT_DESC])->all()[0];
            $assessment = new AssessmentForm();
            
            //CHECK IF STUDENT HAS SIBLINGS ENROLLED
            if((int) $this->student->student_has_sibling_enrolled === 0){
                $assessment->has_sibling_discount = 0;
                $sibling_discount = (float) $tuition->tuition_fee * 0.05;
                $assessment->percentage_value = 5;
                $assessment->sibling_discount = $sibling_discount;
                $assessment->honor_discount = 0;
                $assessment->book_discount = 0;
                $assessment->total_assessed = (float) $tuition->yearly + (float) $tuition->books - $sibling_discount;
                $assessment->balance = (float) $assessment->total_assessed;
            } else {
                $assessment->has_sibling_discount = 1;
                $assessment->sibling_discount = 0;
                $assessment->percentage_value = 0;
                $assessment->honor_discount = 0;
                $assessment->book_discount = 0;
                $assessment->total_assessed = (float) $tuition->yearly + (float) $tuition->books;
                $assessment->balance = (float) $assessment->total_assessed;
            }

            //die($changedAttributes);

            $assessment->has_honor_discount = 1;
            $assessment->has_book_discount = 1;
            $assessment->enrolled_id = (int) $this->id;
            $assessment->tuition_id = $tuition->id;

            $assessment->save();
            Yii::$app->session->setFlash('success2', 'New assessment successfully generated!');
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
            'student' => 'Student Name',
            'student.first_name' => 'First Name',
            'student.middle_name' => 'Middle Name',
            'student.last_name' => 'Last Name',
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

    public function getSyName($id)
    {
        return $this->hasOne(SchoolYear::className(), ['id' => $id]);
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
        if($data === 0){
            return 'Enrolled';
        } else {
            return 'Pending';
        }
    }

    public function getStatusList()
    {
        $statusArray = [
            self::STATUS_NULL => null,
            self::STATUS_PENDING => 'Pending',
            self::STATUS_ENROLLED => 'Enrolled',
        ];
        

        return $statusArray;
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

    public function getSyList(){
        
        $school_year = SchoolYear::find()->orderBy(['id' => SORT_DESC])->all();
        
        $array = [null => null];
        
        for($i = 0; $i < count($school_year); $i++){
            $array[$school_year[$i]->sy] = $school_year[$i]->sy;
        }        
        
        return $array;
    }

    public function getLevelName($grade_level = null)
    {
        $grade_level = (empty($grade_level)) ? $this->grade_level_id : $grade_level ;

        if ($grade_level === self::L121){
            return "Grade 12 2nd Sem";
        } elseif($grade_level === self::L120){
            return "Grade 12 1st Sem";
        } elseif($grade_level === self::L111){
            return "Grade 11 2nd Sem";
        } elseif($grade_level === self::L110){
            return "Grade 11 1st Sem";
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
        } elseif($grade_level === self::L3){
            return "Kinder 2";
        } elseif($grade_level === self::L2){
            return "Kinder 1";
        } elseif($grade_level === self::L1){
            return "Nursery";
        }
    }

    public function getCreatedAt($data) {
        return \Carbon\Carbon::createFromTimestamp($data, 'Asia/Manila')->toFormattedDateString();
    }

    public function getUpdatedAt($data) {        

        return \Carbon\Carbon::createFromTimestamp($data, 'Asia/Manila')->diffForHumans();
    }

    protected function findStudent($id)
    {
        if (($model = StudentForm::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function findAssessment($id)
    {
        if (($model = AssessmentForm::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

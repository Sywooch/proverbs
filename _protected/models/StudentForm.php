<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

class StudentForm extends \yii\db\ActiveRecord
{
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;

    public static function tableName()
    {
        return 'student';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['first_name', 'middle_name', 'last_name', 'gender', 'birth_date', 'religion', 'citizenship', 'address', 'zip_code', 'status', 'fathers_name', 'fathers_citizenship', 'fathers_religion', 'mothers_name', 'mothers_citizenship', 'mothers_religion', 'guardians_name', 'guardians_address', 'guardians_relation_to_student'], 'required'],
            [['birth_date', 'previous_school_from_school_year', 'previous_school_to_school_year', 'status'], 'safe'],
            [['id', 'zip_code', 'mobile', 'phone', 'status', 'fathers_mobile', 'fathers_phone', 'father_is', 'mothers_mobile', 'mothers_phone', 'mother_is', 'parents_are', 'guardians_phone', 'guardians_mobile', 'student_is_living_with', 'grade_level_id', 'previous_school_phone', 'previous_school_mobile', 'previous_school_grade_level', 'previous_school_average_grade', 'student_has_sibling_enrolled', 'student_photo', 'guardians_photo', 'report_card', 'good_moral', 'birth_certificate', 'created_at', 'updated_at', 'gender', 'sped'], 'integer'],
            [['first_name', 'middle_name', 'last_name', 'nickname', 'religion', 'citizenship', 'fathers_name', 'fathers_occupation', 'fathers_employer', 'fathers_citizenship', 'fathers_religion', 'mothers_name', 'mothers_occupation', 'mothers_employer', 'mothers_citizenship', 'mothers_religion', 'guardians_name', 'guardians_relation_to_student', 'guardians_occupation', 'guardians_employer', 'previous_school_description', 'previous_school_teacher_in_charge', 'previous_school_principal'], 'string', 'max' => 45],
            [['address', 'guardians_profile_image', 'guardians_address'], 'string', 'max' => 255],
            [['fathers_email', 'mothers_email', 'previous_school_name', 'previous_school_address'], 'string', 'max' => 128]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'status' => 'Status',
            'grade_level_id' => 'Grade Level ID',
            'first_name' => 'First Name',
            'middle_name' => 'Middle Name',
            'last_name' => 'Last Name',
            'nickname' => 'Nickname',
            'gender' => 'Gender',
            'birth_date' => 'Birth Date',
            'religion' => 'Religion',
            'citizenship' => 'Citizenship',
            'address' => 'Address',
            'zip_code' => 'Zip Code',
            'mobile' => 'Mobile',
            'phone' => 'Phone',
            'fathers_name' => 'Fathers Name',
            'fathers_occupation' => 'Fathers Occupation',
            'fathers_employer' => 'Fathers Employer',
            'fathers_citizenship' => 'Fathers Citizenship',
            'fathers_religion' => 'Fathers Religion',
            'fathers_email' => 'Fathers Email',
            'fathers_mobile' => 'Fathers Mobile',
            'fathers_phone' => 'Fathers Phone',
            'father_is' => 'Father Is',
            'mothers_name' => 'Mothers Name',
            'mothers_occupation' => 'Mothers Occupation',
            'mothers_employer' => 'Mothers Employer',
            'mothers_citizenship' => 'Mothers Citizenship',
            'mothers_religion' => 'Mothers Religion',
            'mothers_email' => 'Mothers Email',
            'mothers_mobile' => 'Mothers Mobile',
            'mothers_phone' => 'Mothers Phone',
            'mother_is' => 'Mother Is',
            'parents_are' => 'Parents Are',
            'guardians_name' => 'Guardians Name',
            'guardians_profile_image' => 'Guardians Profile Image',
            'guardians_address' => 'Guardians Address',
            'guardians_relation_to_student' => 'Guardians Relation To Student',
            'guardians_occupation' => 'Guardians Occupation',
            'guardians_employer' => 'Guardians Employer',
            'guardians_phone' => 'Guardians Phone',
            'guardians_mobile' => 'Guardians Mobile',
            'student_is_living_with' => 'Student Is Living With',
            'previous_school_name' => 'Previous School Name',
            'previous_school_description' => 'Previous School Description',
            'previous_school_address' => 'Previous School Address',
            'previous_school_phone' => 'Previous School Phone',
            'previous_school_mobile' => 'Previous School Mobile',
            'previous_school_grade_level' => 'Previous School Grade Level',
            'previous_school_average_grade' => 'Previous School Average Grade',
            'previous_school_teacher_in_charge' => 'Previous School Teacher In Charge',
            'previous_school_principal' => 'Previous School Principal',
            'previous_school_from_school_year' => 'From School Year',
            'previous_school_to_school_year' => 'To School Year',
            'student_has_sibling_enrolled' => 'Sibling',
            'student_photo' => 'Student Photo',
            'guardians_photo' => 'Guardians Photo',
            'report_card' => 'Report Card',
            'birth_certificate' => 'Birth Certificate',
            'good_moral' => 'Good Moral',            
            'created_at' => 'Date Created',
            'updated_at' => 'Last Updated',
        ];
    }

    public function formatDate($date){
        $months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

        if(strpos($date, '/') !== false){

            $m = trim(substr($date, 0, 2));
            $d = trim(substr($date, 3, 2));
            $Y = substr($date, 6, 4);
            $this->birth_date = $Y . '-' . $m . '-' . $d;
            $date = $this->birth_date;

            return $date;
        }

        if(strpos($date, ',') !== false){
            if(strlen($date) === 12){
                $m = trim(substr($date, 0, 3));

                for($i = 0; $i <= 11; $i++){
                    if($months[$i] === $m){
                        $m = $i+=1;
                        $d = trim(substr($date, 4, 2));
                        $Y = substr($date, 8, 4);
                        $this->birth_date = $this->birth_date = $Y . '-' . $m . '-' . $d;
                        $date = $this->birth_date;

                        return $date;
                    }
                }
            } else {
                $m = trim(substr($date, 0, 3));
                
                for($i = 0; $i <= 11; $i++){
                    if($months[$i] === $m){
                        $m = $i+=1;
                        $d = substr($date, 4, 1);
                        $Y = substr($date, 7, 4);
                        $this->birth_date = $this->birth_date = $Y . '-' . $m . '-' . $d;
                        $date = $this->birth_date;

                        return $date;
                    }
                }
            }
        }

    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if($this->isNewRecord){
                $this->formatDate($this->birth_date);
                return true;
            } else {
                $this->formatDate($this->birth_date);
                return true;
            }
        } else {
            return false;
        }
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

    public function getStatus($data) { // 0:INACTIVE 1:ACTIVE 2: APPLICANT (DEFAULT)
        if($data === 2){
            return 'Applicant';
        } elseif ($data === 1) {
            return 'Active';
        } else {
            return 'Inactive';
        }
    }
    
    public function getStatusList()
    {
        $list = [
            self::STATUS_INACTIVE => 'Inactive',
            self::STATUS_ACTIVE => 'Active',
        ];

        return $list;
    }

    public function getGender($data) { // 0:MALE 1:FEMALE
        if($data === 0){
            return 'Male';
        } else {
            return 'Female';
        }
    }

    public function getParentsAre($data) { //0:Together 1:Separated 2:Widowed 3:Single 4:Marriage Anulled
        if($data === 4){
            return 'Marriage Annulled';
        } elseif ($data === 3) {
            return 'Single';
        } elseif ($data === 2) {
            return 'Widowed';
        } elseif ($data === 1) {
            return 'Separated';
        } else {
            return 'Together';
        }
    }

    public function getMotherIs($data) { //0:Living 1:Deceased
        if($data === 1){
            return 'Living';
        } else {
            return 'Deceased';
        }
    }

    public function getFatherIs($data) { //0:Living 1:Deceased
        if($data === 1){
            return 'Living';
        } else {
            return 'Deceased';
        }
    }

    public function getBirthdate($data) {
        $Y = substr($data, 0, 4);
        $m = substr($data, 5, 2);
        $d = substr($data, 8, 2);
        return \Carbon\Carbon::create($Y, $m, $d)->toFormattedDateString();
    }

    public function getCreatedAt($data) {
        return \Carbon\Carbon::createFromTimestamp($data, 'Asia/Manila')->toFormattedDateString();
    }

    public function getUpdatedAt($data) {        

        return \Carbon\Carbon::createFromTimestamp($data, 'Asia/Manila')->diffForHumans();
    }

    public function getStudentIsLivingWith($data) { //0:Both Parents 1:Father 2:Mother 3:Guardian
        if($data === 3){
            return 'Guardian';
        } elseif ($data === 2) {
            return 'Mother';
        } elseif ($data === 1) {
            return 'Father';
        } else {
            return 'Both';
        }
    }

    public function getGradeLevelId($data)
    {
        if($data === 121){
            return 'Grade 11 2nd Semester';
        } elseif ($data === 120) {
            return 'Grade 12 1st Semester';
        } elseif ($data === 111) {
            return 'Grade 11 2nd Semester';
        } elseif ($data === 110) {
            return 'Grade 11 1st Semester';
        } elseif ($data === 100) {
            return 'Grade 10';
        } elseif ($data === 90) {
            return 'Grade 9';
        } elseif ($data === 80) {
            return 'Grade 8';
        } elseif ($data === 70) {
            return 'Grade 7';
        } elseif ($data === 60) {
            return 'Grade 6';
        } elseif ($data === 50) {
            return 'Grade 5';
        } elseif ($data === 40) {
            return 'Grade 4';
        } elseif ($data === 30) {
            return 'Grade 3';
        } elseif ($data === 20) {
            return 'Grade 2';
        } elseif ($data === 10) {
            return 'Grade 1';
        } elseif ($data === 4) {
            return 'SPED';
        } elseif ($data === 3) {
            return 'Kinder 2';
        } elseif ($data === 2) {
            return 'Kinder 1';
        } elseif ($data === 1) {
            return 'Nursery';
        }
    }

    public function getHasSiblingEnrolled($data) {
        if($data === 1){
            return 'None';
        } else {
            return 'Yes';
        }
    }

    public function getSubmitted($data) { //0:Not Submitted 1:Submitted
        if($data === 1){
            return 'Not Submitted';
        } else {
            return 'Submitted';
        }
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEntranceExams()
    {
        return $this->hasMany(EntranceExam::className(), ['applicant_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPayments()
    {
        return $this->hasMany(Payment::className(), ['student_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGradeLevel()
    {
        return $this->hasOne(GradeLevel::className(), ['id' => 'grade_level_id']);
    }
}

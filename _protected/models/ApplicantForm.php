<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

class ApplicantForm extends \yii\db\ActiveRecord
{
    const STATUS_INACTIVE = 1;
    const STATUS_ACTIVE = 0;
    const STATUS_NULL = null;
    const GENDER_MALE = 0;
    const GENDER_FEMALE = 1;
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

    /**
     * @inheritdoc
     */
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
            [['id', 'first_name', 'middle_name', 'last_name', 'gender', 'birth_date', 'religion', 'citizenship', 'address', 'zip_code', 'fathers_name', 'fathers_citizenship', 'fathers_religion', 'mothers_name', 'mothers_citizenship', 'mothers_religion', 'guardians_name', 'guardians_address', 'guardians_relation_to_student', 'student_photo', 'guardians_photo', 'report_card', 'birth_certificate', 'good_moral', 'status', 'sped'], 'required'],
            [['id', 'zip_code', 'mobile', 'phone', 'fathers_mobile', 'fathers_phone', 'father_is', 'mothers_mobile', 'mothers_phone', 'mother_is', 'parents_are', 'guardians_phone', 'guardians_mobile', 'student_is_living_with', 'student_has_sibling_enrolled', 'student_photo', 'guardians_photo', 'report_card', 'birth_certificate', 'good_moral', 'grade_level_id', 'previous_school_phone', 'previous_school_mobile', 'previous_school_grade_level', 'status', 'created_at', 'updated_at', 'gender'], 'integer'],
            [['previous_school_average_grade'], 'number'],
            [['birth_date', 'previous_school_from_school_year', 'previous_school_to_school_year'], 'safe'],
            [['first_name', 'middle_name', 'last_name', 'nickname', 'religion', 'citizenship', 'fathers_name', 'fathers_occupation', 'fathers_employer', 'fathers_citizenship', 'fathers_religion', 'mothers_name', 'mothers_occupation', 'mothers_employer', 'mothers_citizenship', 'mothers_religion', 'guardians_name', 'guardians_relation_to_student', 'guardians_occupation', 'guardians_employer', 'previous_school_description', 'previous_school_teacher_in_charge', 'previous_school_principal'], 'string', 'max' => 45],
            [['address', 'guardians_profile_image', 'guardians_address'], 'string', 'max' => 255],
            [['fathers_email', 'mothers_email', 'previous_school_name', 'previous_school_address'], 'string', 'max' => 128]
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
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'status' => 'Status',
            'grade_level_id' => 'Grade Level',
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
            'fathers_occupation' => 'Occupation',
            'fathers_employer' => 'Employer',
            'fathers_citizenship' => 'Citizenship',
            'fathers_religion' => 'Religion',
            'fathers_email' => 'Email',
            'fathers_mobile' => 'Mobile',
            'fathers_phone' => 'Phone',
            'father_is' => 'Deceased Father',
            'mothers_name' => 'Mothers Name',
            'mothers_occupation' => 'Occupation',
            'mothers_employer' => 'Employer',
            'mothers_citizenship' => 'Citizenship',
            'mothers_religion' => 'Religion',
            'mothers_email' => 'Email',
            'mothers_mobile' => 'Mobile',
            'mothers_phone' => 'Phone',
            'mother_is' => 'Deceased Mother',
            'parents_are' => 'Parents are',
            'guardians_name' => 'Guardians Name',
            'guardians_profile_image' => 'Profile Image',
            'guardians_address' => 'Guardians Address',
            'guardians_relation_to_student' => 'Relation to student',
            'guardians_occupation' => 'Occupation',
            'guardians_employer' => 'Employer',
            'guardians_phone' => 'Phone',
            'guardians_mobile' => 'Mobile',
            'student_is_living_with' => 'Student is living with',
            'previous_school_name' => 'School Name',
            'previous_school_description' => 'Description',
            'previous_school_address' => 'Address',
            'previous_school_phone' => 'Phone',
            'previous_school_mobile' => 'Mobile',
            'previous_school_grade_level' => 'Grade Level',
            'previous_school_average_grade' => 'Average Grade',
            'previous_school_teacher_in_charge' => 'Teacher In Charge',
            'previous_school_principal' => 'Principal',
            'previous_school_from_school_year' => 'From School Year',
            'previous_school_to_school_year' => 'To School Year',
            'student_has_sibling_enrolled' => 'Sibling Enrolled',
            'students_profile_image' => 'Profile Image',
            'student_photo' => 'Student Photo',
            'guardians_photo' => 'Guardians Photo',
            'report_card' => 'Report Card',
            'birth_certificate' => 'Birth Certificate',
            'good_moral' => 'Good Moral',      
            'sped' => 'SPED',    
            'created_at' => 'Date Created',
            'updated_at' => 'Last Updated',
        ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if($this->isNewRecord){
                $this->formatBirthDate($this->birth_date);
                $this->formatFromDate($this->previous_school_from_school_year);
                $this->formatToDate($this->previous_school_to_school_year);
                return true;
            } else {
                $this->formatBirthDate($this->birth_date);
                $this->formatFromDate($this->previous_school_from_school_year);
                $this->formatToDate($this->previous_school_to_school_year);
                return true;
            }
        } else {
            return false;
        }
    }

    public function formatBirthDate($date){
        $date = \Carbon\Carbon::parse($date)->toFormattedDateString();
        $months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

        if(strpos($date, ',') !== false){
            if(strlen($date) === 12){
                $m = trim(substr($date, 0, 3));

                for($i = 0; $i <= 11; $i++){
                    if($months[$i] === $m){
                        $m = $i+=1;
                        $d = trim(substr($date, 4, 2));
                        $Y = substr($date, 8, 4);
                        $this->birth_date = implode('-', [$Y,$m,$d]);
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
                        $this->birth_date = implode('-', [$Y,$m,$d]);
                        $date = $this->birth_date;
                        return $date;
                    }
                }
            }
        }

    }

    public function formatFromDate($date){

        $date = \Carbon\Carbon::parse($date)->toFormattedDateString();
        $months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

        if(strpos($date, ',') !== false){
            if(strlen($date) === 12){
                $m = trim(substr($date, 0, 3));

                for($i = 0; $i <= 11; $i++){
                    if($months[$i] === $m){
                        $m = $i+=1;
                        $d = trim(substr($date, 4, 2));
                        $Y = substr($date, 8, 4);
                        $this->previous_school_from_school_year = implode('-', [$Y,$m,$d]);
                        $date = $this->previous_school_from_school_year;

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
                        $this->previous_school_from_school_year = implode('-', [$Y,$m,$d]);
                        $date = $this->previous_school_from_school_year;
                        return $date;
                    }
                }
            }
        }

    }

    public function formatToDate($date){
        $date = \Carbon\Carbon::parse($date)->toFormattedDateString();
        $months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

        if(strpos($date, ',') !== false){
            if(strlen($date) === 12){
                $m = trim(substr($date, 0, 3));

                for($i = 0; $i <= 11; $i++){
                    if($months[$i] === $m){
                        $m = $i+=1;
                        $d = trim(substr($date, 4, 2));
                        $Y = substr($date, 8, 4);
                        $this->previous_school_to_school_year = implode('-', [$Y,$m,$d]);
                        $date = $this->previous_school_to_school_year;

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
                        $this->previous_school_to_school_year = implode('-', [$Y,$m,$d]);
                        $date = $this->previous_school_to_school_year;
                        
                        return $date;
                    }
                }
            }
        }

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
            return 'Deceased';
        } else {
            return 'Living';
        }
    }

    public function getFatherIs($data) { //0:Living 1:Deceased
        if($data === 1){
            return 'Deceased';
        } else {
            return 'Living';
        }
    }

    public function getBirthdate($data) {
        $Y = substr($data, 0, 4);
        $m = substr($data, 5, 2);
        $d = substr($data, 8, 2);
        return \Carbon\Carbon::create($Y, $m, $d)->toFormattedDateString();
    }
    public function getCarbonDate($data) {
        return \Carbon\Carbon::parse($data, 'Asia/Manila')->toFormattedDateString();
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
        if($data === 120){
            return 'K2';
        } elseif ($data === 110) {
            return 'K1';
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
        } elseif ($data === 2) {
            return 'Kinder 2';
        } elseif ($data === 1) {
            return 'Kinder 1';
        } elseif ($data === 0) {
            return 'Not Applicable';
        }
    }

    public function getHasSiblingEnrolled($data) { //0:Not Submitted 1:Submitted
        if($data === 1){
            return 'Yes';
        } else {
            return 'No';
        }
    }

    public function getSubmitted($data) { //0:Not Submitted 1:Submitted
        if($data === 1){
            return 'Submitted';
        } else {
            return 'Not Submitted';
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


    public function getGenderList()
    {
        $genderArray = [
            self::N => null,
            self::GENDER_MALE => 'Male',
            self::GENDER_FEMALE => 'Female',
        ];
        

        return $genderArray;
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
            self::L111 => 'Grade 11 1st Sem',
            self::L110 => 'Grade 11 2nd Sem',
            self::L120 => 'Grade 12 1st Sem',
            self::L121 => 'Grade 12 2nd Sem',
        ];
    
        return $levelArray;
    }
}

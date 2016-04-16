<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

class StudentForm extends \yii\db\ActiveRecord
{
    const STATUS_INACTIVE = 1;
    const STATUS_ACTIVE = 0;

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
            [['address', 'guardians_profile_image', 'students_profile_image', 'guardians_address'], 'string', 'max' => 255],
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

    public function formatFrom($date){
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

    public function formatTo($date){
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
                $this->formatFrom($this->previous_school_from_school_year);
                $this->formatTo($this->previous_school_to_school_year);
                return true;
            } else {
                $this->formatDate($this->birth_date);
                $this->formatDate($this->previous_school_from_school_year);
                $this->formatDate($this->previous_school_to_school_year);
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

    public function getStatus($data) { // 0:ACTIVE 1:INACTIVE 2: APPLICANT (DEFAULT)
        if($data === 2){
            return 'Applicant';
        } elseif ($data === 1) {
            return 'Inactive';
        } else {
            return 'Active';
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
        if($data === 0){
            return 'Yes';
        } else {
            return 'No';
        }
    }

    public function getFatherIs($data) { //0:Living 1:Deceased
        if($data === 0){
            return 'Yes';
        } else {
            return 'No';
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

    public function getSubmitted($data) { //0:Submitted 1:Not Submitted 
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

    public function getAge($birth_date)
    {
        $dt = \Carbon\Carbon::parse($birth_date);
        $y = $dt->year;
        $m = $dt->month;
        $d = $dt->day;

        return \Carbon\Carbon::createFromDate($y, $m, $d)->age;
    }
}

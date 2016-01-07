<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

class ApplicantForm extends \yii\db\ActiveRecord
{
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
            [['id', 'first_name', 'middle_name', 'last_name', 'gender', 'birth_date', 'religion', 'citizenship', 'address', 'zip_code', 'fathers_name', 'fathers_citizenship', 'fathers_religion', 'mothers_name', 'mothers_citizenship', 'mothers_religion', 'guardians_name', 'guardians_address', 'guardians_relation_to_student', 'student_photo', 'guardians_photo', 'report_card', 'birth_certificate', 'good_moral', 'status'], 'required'],
            [['id', 'zip_code', 'mobile', 'phone', 'fathers_mobile', 'fathers_phone', 'father_is', 'mothers_mobile', 'mothers_phone', 'mother_is', 'parents_are', 'guardians_phone', 'guardians_mobile', 'student_is_living_with', 'student_has_sibling_enrolled', 'student_photo', 'guardians_photo', 'report_card', 'birth_certificate', 'good_moral', 'grade_level_id', 'previous_school_phone', 'previous_school_mobile', 'previous_school_grade_level', 'previous_school_average_grade', 'status', 'created_at', 'updated_at', 'gender'], 'integer'],
            [['birth_date', 'from_school_year', 'to_school_year'], 'safe'],
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
            'first_name' => 'First Name',
            'middle_name' => 'Middle Name',
            'last_name' => 'Last Name',
            'nickname' => 'Nickname',
            'gender' => 'Gender',
            'birth_date' => 'Date of Birth',
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
            'student_has_sibling_enrolled' => 'Student Has Sibling Enrolled',
            'student_photo' => 'Student Photo',
            'guardians_photo' => 'Guardians Photo',
            'report_card' => 'Report Card',
            'birth_certificate' => 'Birth Certificate',
            'good_moral' => 'Good Moral',
            'grade_level_id' => 'Grade Level ID',
            'previous_school_name' => 'Previous School Name',
            'previous_school_description' => 'Previous School Description',
            'previous_school_address' => 'Previous School Address',
            'previous_school_phone' => 'Previous School Phone',
            'previous_school_mobile' => 'Previous School Mobile',
            'previous_school_grade_level' => 'Previous School Grade Level',
            'previous_school_average_grade' => 'Previous School Average Grade',
            'previous_school_teacher_in_charge' => 'Previous School Teacher In Charge',
            'previous_school_principal' => 'Previous School Principal',
            'from_school_year' => 'From School Year',
            'to_school_year' => 'To School Year',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function beforeSave($insert)
    {
        $date = $this->birth_date;
        $months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

        if (parent::beforeSave($insert)) {

            if($this->isNewRecord){ // CREATE
                if(strstr($date, '/')){
                    $m = trim(substr($date, 0, 2));
                    $d = trim(substr($date, 3, 2));
                    $Y = substr($date, 6, 4);
                    $this->birth_date = $this->birth_date = $Y . '-' . $m . '-' . $d;
                    return true;
                } else {
                    if(strlen($date) === 12){
                        $m = trim(substr($date, 0, 3));

                        for($i = 0; $i <= 11; $i++){
                            if($months[$i] === $m){
                                $m = $i+=1;
                                $d = trim(substr($date, 4, 2));
                                $Y = substr($date, 8, 4);
                                $this->birth_date = $this->birth_date = $Y . '-' . $m . '-' . $d;
                                return true;
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
                                return true;
                            }
                        }
                    }
                }
            } else { // UPDATE
                if(strstr($date, '/')){
                    $m = trim(substr($date, 0, 2));
                    $d = trim(substr($date, 3, 2));
                    $Y = substr($date, 6, 4);

                    $this->birth_date = $this->birth_date = $Y . '-' . $m . '-' . $d;
                    return true;
                } else {
                    if(strlen($date) === 12){
                        $m = trim(substr($date, 0, 3));

                        for($i = 0; $i <= 11; $i++){
                            if($months[$i] === $m){
                                $m = $i+=1;
                                $d = trim(substr($date, 4, 2));
                                $Y = substr($date, 8, 4);
                                $this->birth_date = $this->birth_date = $Y . '-' . $m . '-' . $d;
                                return true;
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
                                return true;
                            }
                        }
                    }
                }
            }
        } else {
            return false;
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
}

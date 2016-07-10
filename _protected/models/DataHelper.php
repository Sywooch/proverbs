<?php

namespace app\models;

use Yii;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use app\models\SchoolYear;
use app\models\User;
use app\models\Section;
use mdm\upload\UploadBehavior;
/*
*	Direct Questions answerable by Yes or No
*	Yes (0)
*	No  (1)
*/
class DataHelper
{
    public static function avatar(){
        $avatar = Yii::$app->request->baseUrl . Yii::$app->params['avatar'];
        return $avatar;
    }

	public static function image($id){
		$user = User::findOne($id);

		return $user;
	}

    public static function carbonDate($data) {

        return \Carbon\Carbon::createFromTimestamp($data, 'Asia/Manila')->toFormattedDateString();
    }

    public static function carbonDateDiff($data) {

        return \Carbon\Carbon::createFromTimestamp($data, 'Asia/Manila')->diffForHumans();
    }

    public static function checkIfEmpty($data, $yes, $no){
        (!empty($data) || $data !== null ) ? $data = $yes : $data = $no;
        return $data;
    }

    public static function direct($data){
        $data === 0 ? $data = 'Yes' : $data = 'No';
        return $data;
    }

    public static function directSpecial($data, $yes, $no){
        $data === 0 ? $data = $yes : $data = $no;
        return $data;
    }

    public static function enrolleeStatus($data){
        $data === 1 ? $data = 'Pending' : $data = 'Enrolled';

        return $data;
    }

	public static function gender($data){
		$data === 0 ? $data = 'Male' : $data = 'Female';
		return $data;
	}

    public static function gradeLevel($data)
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

    public static function menu($role){
        switch ($role) {
            case 'dev':
            $data = implode('',[
                Html::a('Dashboard', implode('/',[Yii::$app->request->baseUrl, 'dashboard']) , ['class' => Yii::$app->controller->id === 'dashboard' ? 'link item active' : 'link item']),
                Html::a('Request',implode('/',[Yii::$app->request->baseUrl, 'request']), ['class' => Yii::$app->controller->id === 'request' ? 'link item active' : 'link item']),
                Html::a('Users',implode('/',[Yii::$app->request->baseUrl, 'user']), ['class' => Yii::$app->controller->id === 'user' ? 'link item active' : 'link item']),
                Html::a('Applicants', implode('/',[Yii::$app->request->baseUrl, 'applicant']), ['class' => Yii::$app->controller->id === 'applicant' ? 'link item active' : 'link item']),
                Html::a('Students', implode('/',[Yii::$app->request->baseUrl, 'students']), ['class' => Yii::$app->controller->id === 'students' ? 'link item active' : 'link item']),
                Html::a('Enrollee', implode('/',[Yii::$app->request->baseUrl, 'enroll']), ['class' => Yii::$app->controller->id === 'enroll' ? 'link item active' : 'link item']),
                Html::a('Assessment', implode('/',[Yii::$app->request->baseUrl, 'assessment']), ['class' => Yii::$app->controller->id === 'assessment' ? 'link item active' : 'link item']),
                Html::a('Payments', implode('/',[Yii::$app->request->baseUrl, 'payments']), ['class' => Yii::$app->controller->id === 'payments' ? 'link item active' : 'link item']),
                Html::a('Entrance Exam', implode('/',[Yii::$app->request->baseUrl, 'entrance-exam']), ['class' => Yii::$app->controller->id === 'entrance-exam' ? 'link item active' : 'link item']),
                Html::a('Section', implode('/',[Yii::$app->request->baseUrl, 'section']), ['class' => Yii::$app->controller->id === 'section' ? 'link item active' : 'link item']),
                Html::a('Class Adviser', implode('/',[Yii::$app->request->baseUrl, 'class-adviser']), ['class' => Yii::$app->controller->id === 'class-adviser' ? 'link item active' : 'link item']),
                Html::a('Assign Subject', implode('/',[Yii::$app->request->baseUrl, 'assign-subject']), ['class' => Yii::$app->controller->id === 'assign-subject' ? 'link item active' : 'link item']),
                //Html::a('Request Data Access', implode('/',[Yii::$app->request->baseUrl, 'request-data']) , ['class' => Yii::$app->controller->id === 'request-data' ? 'link item active' : 'link item']),
            ]);
            break;

            case 'master':
            $data = implode('',[
                Html::a('Dashboard', implode('/',[Yii::$app->request->baseUrl, 'dashboard']) , ['class' => Yii::$app->controller->id === 'dashboard' ? 'link item active' : 'link item']),
                Html::a('Request',implode('/',[Yii::$app->request->baseUrl, 'request']), ['class' => Yii::$app->controller->id === 'request' ? 'link item active' : 'link item']),
                Html::a('Users',implode('/',[Yii::$app->request->baseUrl, 'user']), ['class' => Yii::$app->controller->id === 'user' ? 'link item active' : 'link item']),
                Html::a('Applicants', implode('/',[Yii::$app->request->baseUrl, 'applicant']), ['class' => Yii::$app->controller->id === 'applicant' ? 'link item active' : 'link item']),
                Html::a('Students', implode('/',[Yii::$app->request->baseUrl, 'students']), ['class' => Yii::$app->controller->id === 'students' ? 'link item active' : 'link item']),
                Html::a('Enrollee', implode('/',[Yii::$app->request->baseUrl, 'enroll']), ['class' => Yii::$app->controller->id === 'enroll' ? 'link item active' : 'link item']),
                Html::a('Assessment', implode('/',[Yii::$app->request->baseUrl, 'assessment']), ['class' => Yii::$app->controller->id === 'assessment' ? 'link item active' : 'link item']),
                Html::a('Payments', implode('/',[Yii::$app->request->baseUrl, 'payments']), ['class' => Yii::$app->controller->id === 'payments' ? 'link item active' : 'link item']),
                Html::a('Entrance Exam', implode('/',[Yii::$app->request->baseUrl, 'entrance-exam']), ['class' => Yii::$app->controller->id === 'entrance-exam' ? 'link item active' : 'link item']),
                Html::a('Section', implode('/',[Yii::$app->request->baseUrl, 'section']), ['class' => Yii::$app->controller->id === 'section' ? 'link item active' : 'link item']),
                Html::a('Class Adviser', implode('/',[Yii::$app->request->baseUrl, 'class-adviser']), ['class' => Yii::$app->controller->id === 'class-adviser' ? 'link item active' : 'link item']),
            ]);
            break;

            case 'admin':
            $data = implode('',[
                Html::a('Dashboard', implode('/',[Yii::$app->request->baseUrl, 'dashboard']) , ['class' => Yii::$app->controller->id === 'dashboard' ? 'link item active' : 'link item']),
                Html::a('Request',implode('/',[Yii::$app->request->baseUrl, 'request']), ['class' => Yii::$app->controller->id === 'request' ? 'link item active' : 'link item']),
                Html::a('Users',implode('/',[Yii::$app->request->baseUrl, 'user']), ['class' => Yii::$app->controller->id === 'user' ? 'link item active' : 'link item']),
                Html::a('Applicants', implode('/',[Yii::$app->request->baseUrl, 'applicant']), ['class' => Yii::$app->controller->id === 'applicant' ? 'link item active' : 'link item']),
                Html::a('Students', implode('/',[Yii::$app->request->baseUrl, 'students']), ['class' => Yii::$app->controller->id === 'students' ? 'link item active' : 'link item']),
                Html::a('Enrollee', implode('/',[Yii::$app->request->baseUrl, 'enroll']), ['class' => Yii::$app->controller->id === 'enroll' ? 'link item active' : 'link item']),
                Html::a('Assessment', implode('/',[Yii::$app->request->baseUrl, 'assessment']), ['class' => Yii::$app->controller->id === 'assessment' ? 'link item active' : 'link item']),
                Html::a('Payments', implode('/',[Yii::$app->request->baseUrl, 'payments']), ['class' => Yii::$app->controller->id === 'payments' ? 'link item active' : 'link item']),
                Html::a('Entrance Exam', implode('/',[Yii::$app->request->baseUrl, 'entrance-exam']), ['class' => Yii::$app->controller->id === 'entrance-exam' ? 'link item active' : 'link item']),
                Html::a('Section', implode('/',[Yii::$app->request->baseUrl, 'section']), ['class' => Yii::$app->controller->id === 'section' ? 'link item active' : 'link item']),
                Html::a('Class Adviser', implode('/',[Yii::$app->request->baseUrl, 'class-adviser']), ['class' => Yii::$app->controller->id === 'class-adviser' ? 'link item active' : 'link item']),
            ]);
            break;

            case 'principal':
            $data = implode('',[
                Html::a('Dashboard', implode('/',[Yii::$app->request->baseUrl, 'dashboard']) , ['class' => Yii::$app->controller->id === 'dashboard' ? 'link item active' : 'link item']),
                Html::a('Students', implode('/',[Yii::$app->request->baseUrl, 'students']), ['class' => Yii::$app->controller->id === 'students' ? 'link item active' : 'link item']),
                Html::a('Applicants', implode('/',[Yii::$app->request->baseUrl, 'applicant']), ['class' => Yii::$app->controller->id === 'applicant' ? 'link item active' : 'link item']),
                Html::a('Enrollee', implode('/',[Yii::$app->request->baseUrl, 'enroll']), ['class' => Yii::$app->controller->id === 'enroll' ? 'link item active' : 'link item']),
                Html::a('Entrance Exam', implode('/',[Yii::$app->request->baseUrl, 'entrance-exam']), ['class' => Yii::$app->controller->id === 'entrance-exam' ? 'link item active' : 'link item']),
                Html::a('Section', implode('/',[Yii::$app->request->baseUrl, 'section']), ['class' => Yii::$app->controller->id === 'section' ? 'link item active' : 'link item']),
                Html::a('Class Adviser', implode('/',[Yii::$app->request->baseUrl, 'class-adviser']), ['class' => Yii::$app->controller->id === 'class-adviser' ? 'link item active' : 'link item']),
            ]);
            break;

            case 'teacher':
            $data = implode('',[
                Html::a('Dashboard', implode('/',[Yii::$app->request->baseUrl, 'dashboard']) , ['class' => Yii::$app->controller->id === 'dashboard' ? 'link item active' : 'link item']),
                Html::a('Students', implode('/',[Yii::$app->request->baseUrl, 'students']), ['class' => Yii::$app->controller->id === 'students' ? 'link item active' : 'link item']),
                Html::a('Enrollee', implode('/',[Yii::$app->request->baseUrl, 'enroll']), ['class' => Yii::$app->controller->id === 'enroll' ? 'link item active' : 'link item']),
                Html::a('Entrance Exam', implode('/',[Yii::$app->request->baseUrl, 'entrance-exam']), ['class' => Yii::$app->controller->id === 'entrance-exam' ? 'link item active' : 'link item']),
                Html::a('Section', implode('/',[Yii::$app->request->baseUrl, 'section']), ['class' => Yii::$app->controller->id === 'section' ? 'link item active' : 'link item']),
                Html::a('Class Adviser', implode('/',[Yii::$app->request->baseUrl, 'class-adviser']), ['class' => Yii::$app->controller->id === 'class-adviser' ? 'link item active' : 'link item']),
            ]);
            break;

            case 'cashier':
            $data = implode('',[
                Html::a('Dashboard', implode('/',[Yii::$app->request->baseUrl, 'dashboard']) , ['class' => Yii::$app->controller->id === 'dashboard' ? 'link item active' : 'link item']),
                Html::a('Students', implode('/',[Yii::$app->request->baseUrl, 'students']), ['class' => Yii::$app->controller->id === 'students' ? 'link item active' : 'link item']),
                Html::a('Applicants', implode('/',[Yii::$app->request->baseUrl, 'applicant']), ['class' => Yii::$app->controller->id === 'applicant' ? 'link item active' : 'link item']),
                Html::a('Enrollee', implode('/',[Yii::$app->request->baseUrl, 'enroll']), ['class' => Yii::$app->controller->id === 'enroll' ? 'link item active' : 'link item']),
                Html::a('Entrance Exam', implode('/',[Yii::$app->request->baseUrl, 'entrance-exam']), ['class' => Yii::$app->controller->id === 'entrance-exam' ? 'link item active' : 'link item']),
                Html::a('Payment', implode('/',[Yii::$app->request->baseUrl, 'payments']), ['class' => Yii::$app->controller->id === 'payments' ? 'link item active' : 'link item']),
                Html::a('Section', implode('/',[Yii::$app->request->baseUrl, 'section']), ['class' => Yii::$app->controller->id === 'section' ? 'link item active' : 'link item']),
            ]);
            break;

            case 'staff':

            $data = implode('',[
                Html::a('Dashboard', implode('/',[Yii::$app->request->baseUrl, 'dashboard']) , ['class' => Yii::$app->controller->id === 'dashboard' ? 'link item active' : 'link item']),
                Html::a('Applicants', implode('/',[Yii::$app->request->baseUrl, 'applicant']), ['class' => Yii::$app->controller->id === 'applicant' ? 'link item active' : 'link item']),
                Html::a('Students', implode('/',[Yii::$app->request->baseUrl, 'students']), ['class' => Yii::$app->controller->id === 'students' ? 'link item active' : 'link item']),
                Html::a('Enrollee', implode('/',[Yii::$app->request->baseUrl, 'enroll']), ['class' => Yii::$app->controller->id === 'enroll' ? 'link item active' : 'link item']),
                Html::a('Entrance Exam', implode('/',[Yii::$app->request->baseUrl, 'entrance-exam']), ['class' => Yii::$app->controller->id === 'entrance-exam' ? 'link item active' : 'link item']),
                Html::a('Section', implode('/',[Yii::$app->request->baseUrl, 'section']), ['class' => Yii::$app->controller->id === 'section' ? 'link item active' : 'link item']),
                Html::a('Class Adviser', implode('/',[Yii::$app->request->baseUrl, 'class-adviser']), ['class' => Yii::$app->controller->id === 'class-adviser' ? 'link item active' : 'link item']),
                Html::a('Assigned Teacher', implode('/',[Yii::$app->request->baseUrl, 'assign-subject']), ['class' => Yii::$app->controller->id === 'assign-subject' ? 'link item active' : 'link item']),
            ]);
            break;

            default:
            $data = implode('',[
                Html::a('Dashboard', implode('/',[Yii::$app->request->baseUrl, 'dashboard']) , ['class' => Yii::$app->controller->id === 'dashboard' ? 'item active' : 'item']),
                Html::a('Profile', implode('/',[Yii::$app->request->baseUrl, 'profile']) , ['class' => Yii::$app->controller->id === 'profile' ? 'item active' : 'item']),
                Html::a('Portal', implode('/',[Yii::$app->request->baseUrl, 'portal']) , ['class' => Yii::$app->controller->id === 'portal' ? 'item active' : 'item']),
            ]);
            break;
        }

        return $data;
    }

    public static function name($first, $middle, $last){
    	!empty(trim($middle)) ? $middle = ucfirst(substr($middle, 0,1)) . '.' : $middle = '';

    	$data = implode(' ', [$first, $middle, $last]);

    	return $data;
    }

    public static function profileImage($data){
        $user = User::findOne($data);

        return $user->profile_image;
    }

    public static function username($data){
        $user = User::findOne($data);

        return $user->username;
    }

    public static function userStatus($data){
    	if($data === 1){
    		$data = 'Inactive';
    	}elseif($data === 0){
    		$data = 'Active';
    	}else {
    		$data = 'Deleted';
    	}

    	return $data;
    }

    public static function requestStatus($data){
        $status = null;
    	switch ($data) {
            case 1 :
                $status = 'Processing';
                break;

    	    case 2 :
    	        $status = 'Approved';
    	        break;

    	    case 3 :
    	        $status = 'Denied';
    	        break;

    	    default:
    	        $status = 'Deleted';
    	        break;
    	}

    	return $status;
    }

    public static function roundOff($data, $places){
    	$data = number_format($data, $places);

    	return $data;
    }

    public static function schoolYear($data){
    	$data = SchoolYear::find()->where(['id' => $data])->one();

    	return $data->sy;
    }

    public static function section($data){
    	$data = Section::find()->where(['id' => $data])->one();

    	return $data->section_name;
    }

    public static function siblingDiscount(){
    	$data = array(
    		0 => '0',
    		5 => '5% Discount',
    		6 => '6% Discount',
    		7 => '7% Discount',
    		8 => '8% Discount',
    	);

    	return $data;
    }

    public static function transaction($data){
    	$data === 1 ? $data = 'Cash' : $data = 'Card';

    	return $data;
    }

    public static function paymentDescription($data){
    	switch ($data) {
    	  case 0:
    	    $data = 'Tuition Fee';
    	    break;
    	  case 1:
    	    $data = 'Enrollment Fee';
    	    break;
    	  case 2:
    	    $data = 'Entrance Fee';
    	    break;

    	  default:
    	    $data = 'Others';
    	    break;
    	}

    	return $data;
    }
}

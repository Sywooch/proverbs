<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;
use app\models\SchoolYear;
use app\models\Section;
/*
*	Direct Questions answerable by Yes or No
*	Yes (0)
*	No  (1)
*/
class DataHelper
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

	const ZERO = 0;
	const FIVE = 0.05;
	const SIX = 0.06;
	const SEVEN = 0.07;
	const EIGHT = 0.08;

	public function direct($data){
		$data === 0 ? $data = 'Yes' : $data = 'No';
		return $data;
	}

	public function directSpecial($data, $yes, $no){
		$data === 0 ? $data = $yes : $data = $no;
		return $data;
	}

	public function gender($data){
		$data === 0 ? $data = 'Male' : $data = 'Female';
		return $data;
	}

    public function gradeLevel($data)
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

    public function carbonDate($data) {        

        return \Carbon\Carbon::createFromTimestamp($data, 'Asia/Manila');
    }

    public function carbonDateDiff($data) {

        return \Carbon\Carbon::createFromTimestamp($data, 'Asia/Manila')->diffForHumans();
    }

    public function name($first, $middle, $last){
    	!empty(trim($middle)) ? $middle = ucfirst(substr($middle, 0,1)) . '.' : $middle = '';
    	
    	$data = implode(' ', [$first, $middle, $last]);

    	return $data;
    }

    public function userStatus($data){
    	if($data === 1){
    		$data = 'Inactive';
    	}elseif($data === 0){
    		$data = 'Active';
    	}else {
    		$data = 'Deleted';
    	}

    	return $data;
    }

    public function enrolleeStatus($data){
    	if($data === 1){
    		$data = 'Pending';
    	}else {
    		$data = 'Enrolled';
    	}

    	return $data;
    }

    public function schoolYear($data){
    	$data = SchoolYear::find()->where(['id' => $data])->one();

    	return $data->sy;
    }

    public function section($data){
    	$data = Section::find()->where(['id' => $data])->one();

    	return $data->section_name;
    }


    public function roundOff($data, $places){
    	$data = number_format($data, $places);
    	
    	return $data;
    }

    public function siblingDiscount(){
    	$data = array(
    		0 => '0',
    		5 => '5% Discount',
    		6 => '6% Discount',
    		7 => '7% Discount',
    		8 => '8% Discount',
    	);

    	return $data;
    }
}

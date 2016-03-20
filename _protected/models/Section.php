<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "section".
 *
 * @property integer $id
 * @property string $section_name
 * @property integer $grade_level_id
 *
 * @property Enrolled[] $enrolleds
 * @property GradeLevel $gradeLevel
 */
class Section extends \yii\db\ActiveRecord
{
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
        return 'section';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'grade_level_id'], 'integer'],
            [['section_name'], 'string', 'max' => 20],
            [['section_name'], 'required']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'section_name' => 'Section Name',
            'grade_level_id' => 'Grade Level ID',
            //'grade_level.name' => 'Grade Level',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGradeLevel()
    {
        return $this->hasOne(GradeLevel::className(), ['id' => 'grade_level_id']);
    }

    public function getGradeLevelName()
    {
        return $this->hasOne(GradeLevel::className(), ['id' => 'grade_level_id']);
    }

    public function getLevelList()
    {
        $levelArray = [
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
            self::L111 => 'Grade 11 1st Semester',
            self::L110 => 'Grade 11 2nd Semester',
            self::L120 => 'Grade 12 1st Semester',
            self::L121 => 'Grade 12 2nd Semester',
        ];
        
        return $levelArray;
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
        } elseif($grade_level === self::L3){
            return "Kinder 2";
        } elseif($grade_level === self::L2){
            return "Kinder 1";
        } elseif($grade_level === self::L1){
            return "Nursery";
        }
    }
}

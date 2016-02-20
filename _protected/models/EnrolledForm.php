<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\models\ActiveRecord;
use yii\behaviors\TimestampBehavior;
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
            [['student_id', 'status', 'from_school_year', 'to_school_year', 'created_at', 'updated_at'], 'integer'],
            [['grade_level_id', 'gradeLevel', 'student', 'student.first_name', 'student.middle_name', 'student.last_name'],'safe'],
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
            'student.first_name' => 'First Name',
            'student.middle_name' => 'Middle Name',
            'student.last_name' => 'Last Name',
            'gradeLevel' => 'Grade Level',
            'grade_level_id' => 'Grade Level',
            'status' => 'Status',
            'from_school_year' => 'From',
            'to_school_year' => 'To',
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

    public function getStudentName()
    {
        return $this->hasOne(StudentForm::className(), ['id' => 'student_id']);
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

    public function getStatus($data)
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

    public function getStatusName($status = null)
    {
        $status = (empty($status)) ? $this->status : $status ;

        if ($status === self::STATUS_ENROLLED)
        {
            return "Enrolled";
        }
        else
        {
            return "Pending";
        }
    }

    public function getCreatedAt($data) {
        return \Carbon\Carbon::createFromTimestamp($data, 'Asia/Manila')->toFormattedDateString();
    }

    public function getUpdatedAt($data) {        

        return \Carbon\Carbon::createFromTimestamp($data, 'Asia/Manila')->diffForHumans();
    }
}

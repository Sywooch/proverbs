<?php

namespace app\models;

use Yii;
use yii\helpers\Html;
use app\models\StudentForm;

/**
 * This is the model class for table "request".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $student_id
 * @property integer $request_status
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property User $user
 */
class DataRequest extends \yii\db\ActiveRecord
{
    const PROCESSING = 'Processing';
    const APPROVED = 'Approved';
    const DENIED = 'Denied';
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'request';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['user_id', 'student_id', 'request_status', 'created_at', 'updated_at'], 'integer'],
            [['request_text'], 'string', 'max' => 45],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'Requested By',
            'student_id' => 'Student',
            'request_text' => 'Request Details',
            'request_status' => 'Request Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function getUsername($data)
    {
        $user = \app\models\User::findOne($data);

        return $user->username;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudentDetails($data)
    {
        if(empty($data))return '';

        $student = StudentForm::findOne($data);
        return implode(' ', [$student->first_name, $student->middle_name, $student->last_name . ',', 'ID#' . $student->id]);
    }

    public function getStudent()
    {
        return $this->hasOne(StudentForm::className(), ['id' => 'student_id']);
    }

    public function getStatus($data)
    {
        if($data === 1){
            return self::PROCESSING;
        }elseif ($data === 2) {
            return self::APPROVED;
        }else {
            return self::DENIED;
        }
    }
}

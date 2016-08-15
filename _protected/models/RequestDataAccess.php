<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\behaviors\TimestampBehavior;
use app\models\StudentForm;
/**
 * This is the model class for table "request".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $student_id
 * @property string $request_text
 * @property integer $request_status
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property User $user
 */
class RequestDataAccess extends \yii\db\ActiveRecord
{
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
            [['request_text'], 'string', 'max' => 45],
            [['user_id', 'student_id', 'request_status', 'created_at', 'updated_at'], 'integer'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['student_id'], 'exist', 'skipOnError' => true, 'targetClass' => StudentForm::className(), 'targetAttribute' => ['student_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'student_id' => 'Student ID',
            'request_text' => 'Request Text',
            'request_status' => 'Request Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
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

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if($this->isNewRecord){
                $this->request_status = 1;
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
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudent()
    {
        return $this->hasOne(StudentForm::className(), ['id' => 'student_id']);
    }

    public function test()
    {
        return 'yep';
    }
}

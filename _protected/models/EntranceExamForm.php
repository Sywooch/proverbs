<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * This is the model class for table "entrance_exam".
 *
 * @property string $id
 * @property string $student_id
 * @property integer $interviewer
 * @property integer $english
 * @property integer $reading_skills
 * @property integer $science
 * @property integer $comprehension
 * @property string $remarks
 * @property string $recommendations
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Student $student
 * @property User $interviewer0
 */
class EntranceExamForm extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'entrance_exam';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['applicant_id', 'english', 'reading_skills', 'science', 'comprehension', 'created_at', 'updated_at'], 'integer'],
            [['english', 'reading_skills', 'science', 'comprehension'], 'required'],
            [['remarks', 'recommendations'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'applicant_id' => 'Applicant ID',
            'english' => 'English',
            'reading_skills' => 'Reading Skills',
            'science' => 'Science',
            'comprehension' => 'Comprehension',
            'remarks' => 'Remarks',
            'recommendations' => 'Recommendations',
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

    public function getUpdatedAt($data) {        

        return \Carbon\Carbon::createFromTimestamp($data, 'Asia/Manila')->diffForHumans();
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getApplicant()
    {
        return $this->hasOne(Student::className(), ['id' => 'applicant_id']);
    }
}

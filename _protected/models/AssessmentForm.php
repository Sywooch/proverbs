<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\models\ActiveRecord;
use yii\behaviors\TimestampBehavior;
/**
 * This is the model class for table "assessment".
 *
 * @property string $id
 * @property string $enrolled_id
 * @property integer $tuition_id
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Enrolled $enrolled
 * @property Tuition $tuition
 */
class AssessmentForm extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'assessment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['enrolled_id', 'tuition_id', 'has_sibling_discount', 'has_book_discount', 'has_honor_discount', 'created_at', 'updated_at'], 'integer'],
            [['sibling_discount', 'book_discount', 'honor_discount', 'total_assessed', 'balance'], 'number'],
            [['enrolled_id', 'tuition_id', 'total_assessed', 'balance'], 'required']
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
                $this->has_sibling_discount = 1;
            } else {
                $this->touch('updated_at');
            }
            return true;
        } else {
            return false;
        }
    }

    public function afterSave($insert, $changedAttributes)
    {

        if(!$this->isNewRecord){
            $student = \app\models\StudentForm::findOne((int) $this->enrolled->student_id);
            if($this->has_sibling_discount !== $student->student_has_sibling_enrolled){
                $student->student_has_sibling_enrolled = $this->has_sibling_discount;
                $student->save();
            }
        }
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'enrolled_id' => 'Enrolled ID',
            'tuition_id' => 'Tuition ID',
            'has_sibling_discount' => 'Has Sibling Discount',
            'has_book_discount' => 'Has Book Discount',
            'has_honor_discount' => 'Has Honor Discount',
            'sibling_discount' => 'Sibling Discount',
            'book_discount' => 'Book Discount',
            'honor_discount' => 'Honor Discount',
            'total_assessed' => 'Total Assessed',
            'balance' => 'Balance',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEnrolled()
    {
        return $this->hasOne(EnrolledForm::className(), ['id' => 'enrolled_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTuition()
    {
        return $this->hasOne(Tuition::className(), ['id' => 'tuition_id']);
    }

    public function getCreatedAt($data) {

        return \Carbon\Carbon::createFromTimestamp($data, 'Asia/Manila')->diffForHumans();
    }

    public function getUpdatedAt($data) {        

        return \Carbon\Carbon::createFromTimestamp($data, 'Asia/Manila')->diffForHumans();
    }
}

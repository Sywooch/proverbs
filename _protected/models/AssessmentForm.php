<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\models\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use app\models\StudentForm;
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
    const STATUS_NULL = null;
    const STATUS_PENDING = 1;
    const STATUS_ENROLLED = 0;
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
            [['enrolled_id', 'tuition_id', 'has_sibling_discount', 'has_book_discount', 'has_honor_discount', 'percentage_value', 'created_at', 'updated_at'], 'integer'],
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
                if(empty($this->sibling_discount)){ $this->sibling_discount = 0;}
                if(empty($this->honor_discount)){ $this->honor_discount = 0;}
                if(empty($this->book_discount)){ $this->book_discount = 0;}

                if((int) $this->has_sibling_discount === 1){
                    $this->sibling_discount = 0; $this->percentage_value = 0;
                    self::siblingEnrolled($this->enrolled->student->id, 1);
                }else {
                    self::siblingEnrolled($this->enrolled->student->id, 0);
                }
                if((int) $this->has_honor_discount === 1){$this->honor_discount = 0;}
                if((int) $this->has_book_discount === 1){$this->book_discount = 0;}
                
                $this->created_at = time();
                $this->updated_at = time();

            } else {
                if((int) $this->has_sibling_discount === 1){
                    $this->sibling_discount = 0; $this->percentage_value = 0;
                    self::siblingEnrolled($this->enrolled->student->id, 1);
                }else {
                    self::siblingEnrolled($this->enrolled->student->id, 0);
                }
                if((int) $this->has_book_discount === 1){$this->book_discount = 0;}
                if((int) $this->has_honor_discount === 1){$this->honor_discount = 0;}

                $this->touch('updated_at');

            }
            return true;
        } else {
            return false;
        }
    }

    public function afterSave($insert, $changedAttributes)
    {

    }

    public function calculate(){
        
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
            'sibling_discount_percentage' => 'Percent Discount',
            'sibling_discount' => 'Sibling Discount',
            'book_discount' => 'Book Discount',
            'honor_discount' => 'Honor Discount',
            'total_assessed' => 'Total Assessed',
            'balance' => 'Balance',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function siblingEnrolled($id, $value){
        $student = self::findStudent($id);
        $student->student_has_sibling_enrolled = (int) $value;
        $student->save();
    }

    public function getEnrollmentStatus($data)
    {
        if($data === 0){
            return 'Enrolled';
        } else {
            return 'Pending';
        }
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

    protected function findStudent($id)
    {
        if (($model = StudentForm::findOne($id)) !== null) 
        {
            return $model;
        } 
        else 
        {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;
/**
 * This is the model class for table "payment".
 *
 * @property string $id
 * @property string $student_id
 * @property string $assessment_id
 * @property string $payment_description
 * @property double $paid_amount
 * @property integer $transaction
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Student $student
 * @property Assessment $assessment
 */
class PaymentForm extends \yii\db\ActiveRecord
{
    const TYPE_CASH = 1;
    const TYPE_CARD = 0;

    public static function tableName()
    {
        return 'payment';
    }

    /**
     * @inheritdoc
     */
public function rules()
    {
        return [
            [['student_id', 'assessment_id', 'payment_description', 'transaction', 'created_at', 'updated_at'], 'integer'],
            [['paid_amount'], 'number'],
            [['paid_amount', 'student_id'], 'required'],
            [['student_id'], 'exist', 'skipOnError' => true, 'targetClass' => StudentForm::className(), 'targetAttribute' => ['student_id' => 'id']],
            [['assessment_id'], 'exist', 'skipOnError' => true, 'targetClass' => AssessmentForm::className(), 'targetAttribute' => ['assessment_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'student_id' => 'Student',
            'paid_amount' => 'Amount',
            'assessment_id' => 'Assessment ID',
            'payment_description' => 'Description',
            'transaction' => 'Transaction',
            'created_at' => 'Date of Payment',
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
            [
                'class' => 'mdm\upload\UploadBehavior',
                'attribute' => 'file', // required, use to receive input file
                'savedAttribute' => 'profile_image', // optional, use to link model with saved file.
                'uploadPath' => '@webroot/uploads/users', // saved directory. default to '@runtime/upload'
                'autoSave' => true, // when true then uploaded file will be save before ActiveRecord::save()
                'autoDelete' => true, // when true then uploaded file will deleted before ActiveRecord::delete()
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
     * @return \yii\db\ActiveQuery
     */
    public function getTransaction($data)
    {
        if ($data === 1) {
            return 'Cash';
        } else {
            return 'Card';
        }
    }

    public function getTransactionType()
    {
        $transaction = [
            self::TYPE_CASH => 'Cash',
            self::TYPE_CARD => 'Card',
        ];

        return $transaction;
    }

    public function getPaymentDate($data) {
        return \Carbon\Carbon::parse($data, 'Asia/Manila')->toFormattedDateString();
    }

    public function getCreatedAt($data) {
        return \Carbon\Carbon::createFromTimestamp($data, 'Asia/Manila')->toFormattedDateString();
    }

    public function getUpdatedAt($data) {

        return \Carbon\Carbon::createFromTimestamp($data, 'Asia/Manila')->diffForHumans();
    }

    public function getStudent()
    {
        return $this->hasOne(StudentForm::className(), ['id' => 'student_id']);
    }

    public function getAssessment()
    {
        return $this->hasOne(Assessment::className(), ['id' => 'assessment_id']);
    }
}

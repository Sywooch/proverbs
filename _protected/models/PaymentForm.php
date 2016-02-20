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
 * @property double $paid_amount
 * @property integer $transaction
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Student $student
 */
class PaymentForm extends \yii\db\ActiveRecord
{
    const TYPE_CASH = 0;
    const TYPE_CARD = 1;

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
            [['student_id', 'transaction', 'created_at', 'updated_at'], 'integer'],
            [['paid_amount'], 'number'],
            [['student_id', 'paid_amount'], 'required']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'student_id' => 'Student ID',
            'paid_amount' => 'Paid Amount',
            'transaction' => 'Transaction',
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
            return 'Card';
        } else {
            return 'Cash';
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
        return $this->hasOne(Student::className(), ['id' => 'student_id']);
    }
}

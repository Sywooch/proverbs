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
            [['enrolled_id', 'tuition_id', 'created_at', 'updated_at'], 'integer'],
            [['tuition_id'], 'required']
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
            'enrolled_id' => 'Enrolled ID',
            'tuition_id' => 'Tuition ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEnrolled()
    {
        return $this->hasOne(Enrolled::className(), ['id' => 'enrolled_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTuition()
    {
        return $this->hasOne(Tuition::className(), ['id' => 'tuition_id']);
    }
}
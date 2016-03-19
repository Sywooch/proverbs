<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\models\ActiveRecord;
use yii\behaviors\TimestampBehavior;
/**
 * This is the model class for table "tuition".
 *
 * @property integer $id
 * @property integer $grade_level_id
 * @property double $enrollment
 * @property double $admission
 * @property double $tuition_fee
 * @property double $misc_fee
 * @property double $ancillary
 * @property double $monthly
 * @property double $books
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property GradeLevel $gradeLevel
 */
class Tuition extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tuition';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['grade_level_id', 'created_at', 'updated_at'], 'integer'],
            [['enrollment', 'admission', 'tuition_fee', 'misc_fee', 'ancillary', 'monthly', 'books'], 'number'],
            [['grade_level_id'], 'required']
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
            'grade_level_id' => 'Grade Level ID',
            'enrollment' => 'Enrollment',
            'admission' => 'Admission',
            'tuition_fee' => 'Tuition Fee',
            'misc_fee' => 'Misc Fee',
            'ancillary' => 'Ancillary',
            'monthly' => 'Monthly',
            'books' => 'Books',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGradeLevel()
    {
        return $this->hasOne(GradeLevel::className(), ['id' => 'grade_level_id']);
    }
}

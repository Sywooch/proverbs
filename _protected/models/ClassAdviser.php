<?php

namespace app\models;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;
use Yii;

/**
 * This is the model class for table "advisory".
 *
 * @property integer $user_id
 * @property integer $grade_level_id
 * @property string $sy_id
 *
 * @property User $user
 * @property GradeLevel $gradeLevel
 * @property SchoolYear $sy
 */
class ClassAdviser extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'advisory';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'grade_level_id', 'sy_id'], 'required'],
            [['user_id', 'grade_level_id', 'sy_id', 'created_at', 'updated_at'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'user.last_name' => 'Name',
            'grade_level_id' => 'Grade Level ID',
            'sy_id' => 'Sy ID',
            'created_at' => 'Created At', 
            'updated_at' => 'Updated At'
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
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGradeLevel()
    {
        return $this->hasOne(GradeLevel::className(), ['id' => 'grade_level_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSy()
    {
        return $this->hasOne(SchoolYear::className(), ['id' => 'sy_id']);
    }
}

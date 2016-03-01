<?php

namespace app\models;
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
            [['user_id', 'grade_level_id', 'sy_id'], 'integer']
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
        ];
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

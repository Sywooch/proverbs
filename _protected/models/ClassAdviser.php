<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\models\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
/**
 * This is the model class for table "advisory".
 *
 * @property string $id
 * @property integer $section_id
 * @property integer $teacher_id
 * @property integer $grade_level_id
 * @property string $sy_id
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Section $section
 * @property User $teacher
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

    public function rules()
    {
        return [
            [['section_id', 'teacher_id', 'grade_level_id', 'sy_id', 'created_at', 'updated_at'], 'integer'],
            [['section_id'], 'exist', 'skipOnError' => true, 'targetClass' => Section::className(), 'targetAttribute' => ['section_id' => 'id']],
            [['teacher_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['teacher_id' => 'id']],
            [['grade_level_id'], 'exist', 'skipOnError' => true, 'targetClass' => GradeLevel::className(), 'targetAttribute' => ['grade_level_id' => 'id']],
            [['sy_id'], 'exist', 'skipOnError' => true, 'targetClass' => SchoolYear::className(), 'targetAttribute' => ['sy_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'section_id' => 'Section',
            'teacher_id' => 'Teacher',
            'grade_level_id' => 'Grade Level',
            'sy_id' => 'School Year',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
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

    public function getSection()
    {
        return $this->hasOne(Section::className(), ['id' => 'section_id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSy()
    {
        return $this->hasOne(SchoolYear::className(), ['id' => 'sy_id']);
    }

    public function getTeacher()
    {
        return $this->hasOne(User::className(), ['id' => 'teacher_id']);
    }
}

<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "grade_level".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 *
 * @property Student[] $students
 */
class GradeLevel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'grade_level';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id'], 'integer'],
            [['name'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'gradeLevel.name' => 'Grade Level'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudents()
    {
        return $this->hasMany(Student::className(), ['grade_level_id' => 'id']);
    }

    public function getAllLevels()
    {
        $level = self::find()->all();

        return $level;
    }

    public function getLevels()
    {
        return static::find()
            ->select(['id'])
            ->all();
    }
}

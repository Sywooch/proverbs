<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "subject".
 *
 * @property integer $id
 * @property string $subject_name
 *
 * @property Assigned[] $assigneds
 * @property LearningArea[] $learningAreas
 */
class Subject extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'subject';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['subject_name'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'subject_name' => 'Subject Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAssigneds()
    {
        return $this->hasMany(Assigned::className(), ['subject_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLearningAreas()
    {
        return $this->hasMany(LearningArea::className(), ['subject_id' => 'id']);
    }
}

<?php
namespace app\models;
use Yii;

/**
 * This is the model class for table "school_year".
 *
 * @property string $id
 * @property string $sy
 *
 * @property Advisory[] $advisories
 * @property Assigned[] $assigneds
 * @property Enrolled[] $enrolleds
 */
class SchoolYear extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'school_year';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sy'], 'string', 'max' => 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sy' => 'School Year',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdvisories()
    {
        return $this->hasMany(Advisory::className(), ['sy_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAssigned()
    {
        return $this->hasMany(Assigned::className(), ['sy_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEnrolled()
    {
        return $this->hasMany(Enrolled::className(), ['sy_id' => 'id']);
    }
}
<?php

namespace app\models;

use Yii;
use yii\models\ActiveRecord;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "board".
 *
 * @property string $id
 * @property string $content
 * @property integer $posted_by
 * @property integer $created_at
 *
 * @property User $postedBy
 */
class Board extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'board';
    }
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    \yii\db\ActiveRecord::EVENT_BEFORE_INSERT => ['created_at'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['posted_by'], 'required'],
            [['posted_by', 'created_at'], 'integer'],
            [['content'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'content' => 'Content',
            'posted_by' => 'Posted By',
            'created_at' => 'Created At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPostedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'posted_by']);
    }
    
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'posted_by']);
    }
}
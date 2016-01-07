<?php

namespace app\models;

use Yii;
use yii\nesbot\Carbon;
/**
 * This is the model class for table "message".
 *
 * @property string $id
 * @property integer $sender
 * @property integer $recepient
 * @property string $content
 * @property string $created_at
 */
class Messages extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'message';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //[['sender', 'recepient'], 'integer'],
            [['content', 'created_at'], 'required'],
            [['created_at'], 'safe'],
            [['content'], 'string', 'max' => 255],
            [['sender'], 'exist', 'targetClass' => '\app\models\User', 'targetAttribute' => 'id', 'message' => Yii::t('app', 'Oops, user does not exist.')],
            [['recepient'], 'exist', 'targetClass' => '\app\models\User', 'targetAttribute' => 'id', 'message' => Yii::t('app', 'Oops, user does not exist.')]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sender' => 'Sender',
            'recepient' => 'Recepient',
            'content' => 'Content',
            'created_at' => 'Created At',
        ];
    }
    
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if($this->isNewRecord)
                $this->created_at = \Carbon\Carbon::now()->setTimeZone('Asia/Manila');
            return true;
        } else {
            return false;
        }
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSender()
    {
        return $this->hasOne(User::className(), ['id' => 'sender']);
    }

    public function getSenderName()
    {
        return $this->hasOne(User::className(), ['id' => 'sender']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRecepeint()
    {
        return $this->hasOne(User::className(), ['id' => 'recepient']);
    }
}

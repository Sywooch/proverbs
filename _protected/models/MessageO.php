<?php

namespace app\models;

use Yii;
use yii\nesbot\Carbon;
/**
 * This is the model class for table "message".
 *
 * @property string $id
 * @property integer $sender
 * @property integer $receiver
 * @property string $content
 * @property string $created_at
 *
 * @property User $sender0
 * @property User $receiver0
 */
class Message extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'message';
    }

    public function rules()
    {
        return [
            //[['sender', 'receiver'], 'integer'],
            [['content', 'created_at'], 'required'],
            [['sender', 'created_at'], 'safe'],
            [['content'], 'string', 'max' => 255],
            [['receiver'], 'exist', 'targetClass' => '\app\models\User', 'targetAttribute' => 'id', 'message' => Yii::t('app', 'Oops, user does not exist.')]
        ];
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return ([
            'id' => 'ID',
            'sender' => 'From',
            'senderName.userame' => 'From',
            'receiver' => 'To',
            'content' => 'Message',
            'created_at' => 'Date',
        ]);
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if($this->isNewRecord)
                $this->created_at = \Carbon\Carbon::now();
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
    public function getReceiver()
    {
        return $this->hasOne(User::className(), ['id' => 'receiver']);
    }
}

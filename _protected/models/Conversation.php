<?php

namespace app\models;

use Yii;

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
class Conversation extends \yii\db\ActiveRecord
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
            [['sender', 'receiver'], 'integer'],
            [['content', 'created_at'], 'required'],
            [['created_at'], 'safe'],
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
            'sender' => 'Sender',
            'receiver' => 'Receiver',
            'content' => 'Content',
            'created_at' => 'Created At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSender0()
    {
        return $this->hasOne(User::className(), ['id' => 'sender']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReceiver0()
    {
        return $this->hasOne(User::className(), ['id' => 'receiver']);
    }
}

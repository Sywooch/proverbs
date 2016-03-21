<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\models\ActiveRecord;
use yii\behaviors\TimestampBehavior;
/**
 * This is the model class for table "announcement".
 *
 * @property integer $id
 * @property string $content
 * @property integer $posted_by
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property User $postedBy
 */
class Announcement extends \yii\db\ActiveRecord
{
/*    public $jsFile;

    public function init() {
        parent::init();

        $this->jsFile = '@app/views/' . $this->id . '/ajax.js';
        Yii::$app->assetManager->publish($this->jsFile);
        $this->getView()->registerJsFile(
            Yii::$app->assetManager->getPublishedUrl($this->jsFile),
            ['yii\web\YiiAsset']
        );
    }*/

    public static function tableName()
    {
        return 'announcement';
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['content', 'created_at', 'updated_at'], 'required'],
            [['posted_by', 'created_at', 'updated_at'], 'integer'],
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
            ]
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
    public function getPostedBy($data)
    {
        $model = User::find()->where(['id' => $data])->one();
        return $model->username;
        //return $this->hasOne(User::className(), ['id' => $data]);
    }
}

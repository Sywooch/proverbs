<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Message;

/**
 * MessageSearch represents the model behind the search form about `app\models\Message`.
 */
class MessageSearch extends Message
{
    public function attributes()
    {
        // add related fields to searchable attributes
        return array_merge(parent::attributes(), ['sender.username']);
    }

    public function rules()
    {
        return [
            [['id', 'receiver'], 'integer'],
            [['sender', 'sender.username', 'content', 'created_at'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function searchOwnMessages($params)
    {
        $query = Message::find()
            ->joinWith([
                'sender' => function($query) { 
                    $query->from(['senderName' => 'user']); 
                }
            ]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['senderName.username'] = [
            'asc' => ['senderName.username' => SORT_ASC],
            'desc' => ['senderName.username' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }
        
        $query->joinWith('senderName');
        //$query->where(['like', 'senderName.username', $this->sender]);
        
        $query
        ->andFilterWhere([
            'content' => $this->content,
            ])
        ->andFilterWhere(['like', 'senderName.username', $this->sender])
        ->andFilterWhere(['like', 'created_at', $this->created_at])
        ->andFilterWhere(['receiver' => Yii::$app->user->identity->id]);
        

        return $dataProvider;
    }

}

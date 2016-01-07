<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Messages;

/**
 * MessageSearch represents the model behind the search form about `app\models\Message`.
 */
class MessagesSearch extends Messages
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'recepient'], 'integer'],
            [['sender', 'content', 'created_at'], 'safe'],
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
        $query = Messages::find()
            ->joinWith([
                'sender' => function($query) { 
                    $query->from(['senderName' => 'user']); 
                }
            ]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['created_at'] = [
            'asc' => ['created_at' => SORT_ASC],
            'desc' => ['created_at' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }
        
        $query->joinWith('senderName');
        
        $query
        ->andFilterWhere(['content' => $this->content,])
        ->andFilterWhere(['like', 'senderName.username', $this->sender])
        ->andFilterWhere(['like', 'created_at', $this->created_at])
        ->andFilterWhere(['recepient' => Yii::$app->user->identity->id])
        //->groupBy('sender')
        ->orderBy(['created_at' => SORT_DESC]);
        

        return $dataProvider;
    }
}

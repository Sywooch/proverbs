<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Section;

/**
 * SectionSearch represents the model behind the search form about `app\models\Section`.
 */
class SectionSearch extends Section
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'grade_level_id'], 'integer'],
            [['section_name'], 'safe'],
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

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Section::find();
        $pageSize = 20;

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['section_name'] = [
            'asc' => ['section_name' => SORT_ASC],
            'desc' => ['section_name' => SORT_DESC],
        ];
        
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['section_name'=>SORT_ASC]],
            'pagination' => [
                'pageSize' => $pageSize,
            ]
        ]);
        
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'grade_level_id' => $this->grade_level_id,
        ]);

        $query->andFilterWhere(['like', 'section_name', $this->section_name]);

        return $dataProvider;
    }

    public function searchSection($params)
    {
        $query = Section::find();
        $pageSize = 10;

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['section_name'] = [
            'asc' => ['section_name' => SORT_ASC],
            'desc' => ['section_name' => SORT_DESC],
        ];
        
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['section_name'=>SORT_ASC]],
            'pagination' => [
                'pageSize' => $pageSize,
            ]
        ])
        ;
        
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'grade_level_id' => $this->grade_level_id,
        ])
        ;

        $query->andFilterWhere(['like', 'section_name', $this->section_name])
            
        ;

        return $dataProvider;
    }
}

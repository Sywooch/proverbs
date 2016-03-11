<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\LearningArea;

/**
 * LearningAreaSearch represents the model behind the search form about `app\models\LearningArea`.
 */
class LearningAreaSearch extends LearningArea
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'grade_level_id', 'subject_id', 'sequence', 'semester', 'revision'], 'integer'],
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
        $query = LearningArea::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
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
            'subject_id' => $this->subject_id,
            'sequence' => $this->sequence,
            'semester' => $this->semester,
            'revision' => $this->revision,
        ]);

        return $dataProvider;
    }
}

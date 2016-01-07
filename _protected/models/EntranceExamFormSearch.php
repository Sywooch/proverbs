<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\EntranceExamForm;

/**
 * EntranceExamFormSearch represents the model behind the search form about `app\models\EntranceExamForm`.
 */
class EntranceExamFormSearch extends EntranceExamForm
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'applicant_id', 'english', 'reading_skills', 'science', 'comprehension', 'created_at', 'updated_at'], 'integer'],
            [['remarks', 'recommendations'], 'safe'],
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
        $query = EntranceExamForm::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['id'=>SORT_DESC]],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'applicant_id' => $this->applicant_id,
            'english' => $this->english,
            'reading_skills' => $this->reading_skills,
            'science' => $this->science,
            'comprehension' => $this->comprehension,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'remarks', $this->remarks])
            ->andFilterWhere(['like', 'recommendations', $this->recommendations]);

        return $dataProvider;
    }
}

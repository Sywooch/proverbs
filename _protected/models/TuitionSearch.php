<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Tuition;

/**
 * TuitionSearch represents the model behind the search form about `app\models\Tuition`.
 */
class TuitionSearch extends Tuition
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'grade_level_id', 'created_at', 'updated_at'], 'integer'],
            [['enrollment', 'admission', 'tuition_fee', 'misc_fee', 'ancillary', 'monthly', 'books'], 'number'],
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
        $query = Tuition::find();

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
            'enrollment' => $this->enrollment,
            'admission' => $this->admission,
            'tuition_fee' => $this->tuition_fee,
            'misc_fee' => $this->misc_fee,
            'ancillary' => $this->ancillary,
            'monthly' => $this->monthly,
            'books' => $this->books,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        return $dataProvider;
    }
}

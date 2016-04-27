<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AssessmentForm;

/**
 * AssessmentFormSearch represents the model behind the search form about `app\models\AssessmentForm`.
 */
class AssessmentFormSearch extends AssessmentForm
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'enrolled_id', 'tuition_id', 'percentage_value', 'created_at', 'updated_at'], 'integer'],
            [['sibling_discount', 'book_discount', 'honor_discount', 'total_assessed', 'balance'], 'number'],
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
        $query = AssessmentForm::find();

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
            'enrolled_id' => $this->enrolled_id,
            'tuition_id' => $this->tuition_id,
            'sibling_discount' => $this->sibling_discount,
            'book_discount' => $this->book_discount,
            'honor_discount' => $this->honor_discount,
            'total_assessed' => $this->total_assessed,
            'balance' => $this->balance,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        return $dataProvider;
    }

    public function searchAssessment($params)
    {
        $query = AssessmentForm::find();
        $pageSize = Yii::$app->params['pageSize'];

        $dataProvider->sort->attributes['id'] = [
            'asc' => ['id' => SORT_ASC],
            'desc' => ['id' => SORT_DESC],
        ];

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['id'=>SORT_DESC]],
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
            'enrolled_id' => $this->enrolled_id,
            'tuition_id' => $this->tuition_id,
            'sibling_discount' => $this->sibling_discount,
            'sibling_percentage_value' => $this->percentage_value,
            'book_discount' => $this->book_discount,
            'honor_discount' => $this->honor_discount,
            'total_assessed' => $this->total_assessed,
            'balance' => $this->balance,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        return $dataProvider;
    }
}

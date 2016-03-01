<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\GradeElevenFirstSemForm;

/**
 * GradeElevenFirstSemFormSearch represents the model behind the search form about `app\models\GradeElevenFirstSemForm`.
 */
class GradeElevenFirstSemFormSearch extends GradeElevenFirstSemForm
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'grade_protection', 'enrolled_id', 'grading_period', 'core_value_1', 'core_value_2', 'core_value_3', 'core_value_4', 'subject_1', 'subject_2', 'subject_3', 'subject_4', 'subject_5', 'subject_6', 'subject_7', 'subject_8', 'subject_9', 'subject_10'], 'integer'],
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
        $query = GradeElevenFirstSemForm::find();

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
            'grade_protection' => $this->grade_protection,
            'enrolled_id' => $this->enrolled_id,
            'grading_period' => $this->grading_period,
            'core_value_1' => $this->core_value_1,
            'core_value_2' => $this->core_value_2,
            'core_value_3' => $this->core_value_3,
            'core_value_4' => $this->core_value_4,
            'subject_1' => $this->subject_1,
            'subject_2' => $this->subject_2,
            'subject_3' => $this->subject_3,
            'subject_4' => $this->subject_4,
            'subject_5' => $this->subject_5,
            'subject_6' => $this->subject_6,
            'subject_7' => $this->subject_7,
            'subject_8' => $this->subject_8,
            'subject_9' => $this->subject_9,
            'subject_10' => $this->subject_10,
        ]);

        return $dataProvider;
    }
}

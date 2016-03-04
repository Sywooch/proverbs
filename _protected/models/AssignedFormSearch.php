<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AssignedForm;

/**
 * AssignedFormSearch represents the model behind the search form about `app\models\AssignedForm`.
 */
class AssignedFormSearch extends AssignedForm
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'sy_id', 'grade_level_id', 'teacher_id', 'section_id', 'subject_id'], 'integer'],
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
        $query = AssignedForm::find();

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
            'sy_id' => $this->sy_id,
            'grade_level_id' => $this->grade_level_id,
            'teacher_id' => $this->teacher_id,
            'section_id' => $this->section_id,
            'subject_id' => $this->subject_id,
        ]);

        return $dataProvider;
    }
}

<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ClassAdviserForm;

/**
 * ClassAdviserFormSearch represents the model behind the search form about `app\models\ClassAdviserForm`.
 */
class ClassAdviserFormSearch extends ClassAdviserForm
{
    public function attributes()
    {
        return array_merge(parent::attributes(), ['grade_level_id', 'gradeLevel', 'gradeLevel.name', 'sy.sy', 'sy_id', 'section.section_name', 'section_id', 'teacher', 'teacher.last_name']);
    }

    public function rules()
    {
        return [
            [['grade_level_id', 'id'], 'integer'],
            [['grade_level_id', 'gradeLevel.name', 'sy', 'sy_id', 'sy.sy', 'section', 'section.section_name', 'teacher_id', 'teacher', 'teacher.last_name'], 'safe'],
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
        $query = ClassAdviserForm::find();

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
            'grade_level_id' => $this->grade_level_id,
            'sy_id' => $this->sy_id,
        ]);

        return $dataProvider;
    }

    public function searchClassAdviser($params)
    {
        $pageSize = 20;

        $query = ClassAdviserForm::find()
            ->joinWith(['gradeLevel' => function($query) {
                $query->from(['gradeLevelName' => 'grade_level']);
            }])
            ->joinWith(['sy' => function($query) {
                $query->from(['sy' => 'school_year']);
            }])
            ->joinWith(['sectionName' => function($query) {
                $query->from(['section' => 'section']);
            }])
            ->joinWith(['teacherName' => function($query) {
                $query->from(['teacher' => 'user']);
            }])
        ;

        $dataProvider->sort->attributes['sy_id'] = [
            'asc' => ['sy_id' => SORT_ASC],
            'desc' => ['sy_id' => SORT_DESC],
        ];
        
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['sy_id'=>SORT_DESC, 'id'=>SORT_ASC]],
            'pagination' => [
                'pageSize' => $pageSize,
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            //'teacher_id' => $this->teacher_id,
            'grade_level_id' => $this->grade_level_id,
        ])
            ->andFilterWhere(['like', 'sy.sy', $this->sy_id])
            ->andFilterWhere(['like', 'section.section_name', $this->section_id])
            ->andFilterWhere(['like', 'teacher.last_name', $this->teacher_id])
            ;

        return $dataProvider;
    }
}

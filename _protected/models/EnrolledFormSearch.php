<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\EnrolledForm;
use app\models\GradeLevel;

/**
 * EnrolledFormSearch represents the model behind the search form about `app\models\EnrolledForm`.
 */
class EnrolledFormSearch extends EnrolledForm
{
    public function attributes()
    {
        // add related fields to searchable attributes
        return array_merge(parent::attributes(), ['gradeLevel.name', 'student.first_name', 'student.middle_name',  'student.last_name']);
    }

    public function rules()
    {
        return [    
            [['id', 'status', 'from_school_year', 'to_school_year', 'created_at', 'updated_at'], 'integer'],
            [['grade_level_id', 'gradeLevel.name', 'student_id', 'student.first_name', 'student.middle_name',  'student.last_name'], 'safe'],
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
        $query = EnrolledForm::find();

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
            'student_id' => $this->student_id,
            'grade_level_id' => $this->grade_level_id,
            'status' => $this->status,
            'from_school_year' => $this->from_school_year,
            'to_school_year' => $this->to_school_year,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        return $dataProvider;
    }

    public function searchEnrolled($params)
    {
        $pageSize = 10;
        
        //'relation name' => function($query){$query->from(['alias table/method' => 'table_name']);}
        $query = EnrolledForm::find()
            ->joinWith(['gradeLevel' => function($query) {
                $query->from(['gradeLevelName' => 'grade_level']);
            }])
            ->joinWith(['student' => function($query) {
                $query->from(['studentName' => 'student']);
            }]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['id'=>SORT_DESC]],
            'pagination' => [
                'pageSize' => $pageSize,
            ]
        ]);

        $dataProvider->sort->attributes['gradeLevel.name'] = [
            'asc' => ['gradeLevel.name' => SORT_ASC],
            'desc' => ['gradeLevel.name' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['studentName.first_name'] = [
            'asc' => ['studentName.first_name' => SORT_ASC],
            'desc' => ['studentName.first_name' => SORT_DESC],
        ];
/*
        $dataProvider->sort->attributes['studentName.last_name'] = [
            'asc' => ['studentName.last_name' => SORT_ASC],
            'desc' => ['studentName.last_name' => SORT_DESC],
        ];*/

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        //$query->joinWith('method');
        $query->joinWith('gradeLevelName');
        $query->joinWith('studentName');

        $query
        ->andFilterWhere([
            'id' => $this->id,
            //'student_id' => $this->student_id,
            //'grade_level_id' => $this->grade_level_id,
            'status' => $this->status,
            'from_school_year' => $this->from_school_year,
            'to_school_year' => $this->to_school_year,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ])
        ->andFilterWhere(['like', 'gradeLevelName.name', $this->grade_level_id])
        ->andFilterWhere(['like', 'studentName.first_name', $this->student_id])
        //->andFilterWhere(['like', 'studentName.last_name', $this->student_id])
        ;

        return $dataProvider;
    }
}

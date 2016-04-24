<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\EnrolledForm;
use app\models\GradeLevel;
use app\models\StudentForm;
use yii\web\NotFoundHttpException;

/**
 * EnrolledFormSearch represents the model behind the search form about `app\models\EnrolledForm`.
 */
class EnrolledFormSearch extends EnrolledForm
{
    public function attributes()
    {
        // add related fields to searchable attributes
        return array_merge(parent::attributes(), ['student.last_name', 'student.first_name', 'student.middle_name', 'sy.sy', 'section.section_name']);
    }

    public function rules()
    {
        return [    
            [['id', 'enrollment_status', 'created_at', 'updated_at', 'student_id', 'grade_level_id', 'section_id'], 'integer'],
            [['student.first_name'],'string'],
            [['student' ,'student_id', 'student.last_name', 'student.first_name', 'student.middle_name', 'sy_id', 'section', 'section.section_name'], 'safe'],
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
            'enrollment_status' => $this->enrollment_status,
            'sy_id' => $this->sy_id,
            'section_id' => $this->section_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        return $dataProvider;
    }

    public function searchEnrolled($params)
    {
        $pageSize = Yii::$app->params['pageSize'];
        
        $query = EnrolledForm::find()
            ->joinWith(['gradeLevel' => function($query) {
                $query->from(['gradeLevelName' => 'grade_level']);
            }])
            // ->joinWith(['student' => function($query) {
            //     $query->from(['stud' => 'student']);
            // }])
            ->joinWith(['sy' => function($query) {
                $query->from(['sy' => 'school_year']);
            }])
            ;
            /*->joinWith(['relation name' => function($query) {
                $query->from(['alias' => 'table name']);
                //$query->from(['method' => 'table name']);
            }])*/

        $dataProvider->sort->attributes['sy_id'] = [
            'asc' => ['sy_id' => SORT_ASC],
            'desc' => ['sy_id' => SORT_DESC],
        ];
        
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['id'=>SORT_DESC, 'sy_id'=>SORT_DESC]],
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

        //$query->joinWith('method');
        //$query->joinWith('relation');
        $query->joinWith('gradeLevelName');
        //$query->joinWith('student');

        $query
        ->andFilterWhere([
            'id' => $this->id,
            'student_id' => $this->student_id,
            'grade_level_id' => $this->grade_level_id,
            'section_id' => $this->section_id,
            'enrollment_status' => $this->enrollment_status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ])
        //->andFilterWhere(['like', 'gradeLevelName.name', $this->grade_level_id])
        //->andFilterWhere(['like', 'student.last_name', $this->student_id])
        //->andFilterWhere(['like', 'student_id', $this->student_id])
        //->andFilterWhere(['like', 'student', $this->student['first_name']])
        ->andFilterWhere(['like', 'sy.sy', $this->sy_id])
        ;

        return $dataProvider;
    }
}

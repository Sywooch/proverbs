<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\StudentForm;

/**
 * StudentFormSearch represents the model behind the search form about `app\models\StudentForm`.
 */
class StudentFormSearch extends StudentForm
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'gender', 'zip_code', 'mobile', 'phone', 'fathers_mobile', 'fathers_phone', 'father_is', 'mothers_mobile', 'mothers_phone', 'mother_is', 'parents_are', 'guardians_phone', 'guardians_mobile', 'student_is_living_with', 'student_has_sibling_enrolled', 'student_photo', 'guardians_photo', 'report_card', 'birth_certificate', 'good_moral', 'grade_level_id', 'previous_school_phone', 'previous_school_mobile', 'previous_school_grade_level', 'previous_school_average_grade', 'status', 'created_at', 'updated_at'], 'integer'],
            [['first_name', 'middle_name', 'last_name', 'nickname', 'birth_date', 'religion', 'citizenship', 'address', 'fathers_name', 'fathers_occupation', 'fathers_employer', 'fathers_citizenship', 'fathers_religion', 'fathers_email', 'mothers_name', 'mothers_occupation', 'mothers_employer', 'mothers_citizenship', 'mothers_religion', 'mothers_email', 'guardians_name', 'guardians_profile_image', 'guardians_address', 'guardians_relation_to_student', 'guardians_occupation', 'guardians_employer', 'previous_school_name', 'previous_school_description', 'previous_school_address', 'previous_school_teacher_in_charge', 'previous_school_principal', 'from_school_year', 'to_school_year'], 'safe'],
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
        $query = StudentForm::find();

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
            'gender' => $this->gender,
            'birth_date' => $this->birth_date,
            'zip_code' => $this->zip_code,
            'mobile' => $this->mobile,
            'phone' => $this->phone,
            'fathers_mobile' => $this->fathers_mobile,
            'fathers_phone' => $this->fathers_phone,
            'father_is' => $this->father_is,
            'mothers_mobile' => $this->mothers_mobile,
            'mothers_phone' => $this->mothers_phone,
            'mother_is' => $this->mother_is,
            'parents_are' => $this->parents_are,
            'guardians_phone' => $this->guardians_phone,
            'guardians_mobile' => $this->guardians_mobile,
            'student_is_living_with' => $this->student_is_living_with,
            'student_has_sibling_enrolled' => $this->student_has_sibling_enrolled,
            'student_photo' => $this->student_photo,
            'guardians_photo' => $this->guardians_photo,
            'report_card' => $this->report_card,
            'birth_certificate' => $this->birth_certificate,
            'good_moral' => $this->good_moral,
            'grade_level_id' => $this->grade_level_id,
            'previous_school_phone' => $this->previous_school_phone,
            'previous_school_mobile' => $this->previous_school_mobile,
            'previous_school_grade_level' => $this->previous_school_grade_level,
            'previous_school_average_grade' => $this->previous_school_average_grade,
            'from_school_year' => $this->from_school_year,
            'to_school_year' => $this->to_school_year,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'first_name', $this->first_name])
            ->andFilterWhere(['like', 'middle_name', $this->middle_name])
            ->andFilterWhere(['like', 'last_name', $this->last_name])
            ->andFilterWhere(['like', 'nickname', $this->nickname])
            ->andFilterWhere(['like', 'religion', $this->religion])
            ->andFilterWhere(['like', 'citizenship', $this->citizenship])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'fathers_name', $this->fathers_name])
            ->andFilterWhere(['like', 'fathers_occupation', $this->fathers_occupation])
            ->andFilterWhere(['like', 'fathers_employer', $this->fathers_employer])
            ->andFilterWhere(['like', 'fathers_citizenship', $this->fathers_citizenship])
            ->andFilterWhere(['like', 'fathers_religion', $this->fathers_religion])
            ->andFilterWhere(['like', 'fathers_email', $this->fathers_email])
            ->andFilterWhere(['like', 'mothers_name', $this->mothers_name])
            ->andFilterWhere(['like', 'mothers_occupation', $this->mothers_occupation])
            ->andFilterWhere(['like', 'mothers_employer', $this->mothers_employer])
            ->andFilterWhere(['like', 'mothers_citizenship', $this->mothers_citizenship])
            ->andFilterWhere(['like', 'mothers_religion', $this->mothers_religion])
            ->andFilterWhere(['like', 'mothers_email', $this->mothers_email])
            ->andFilterWhere(['like', 'guardians_name', $this->guardians_name])
            ->andFilterWhere(['like', 'guardians_profile_image', $this->guardians_profile_image])
            ->andFilterWhere(['like', 'guardians_address', $this->guardians_address])
            ->andFilterWhere(['like', 'guardians_relation_to_student', $this->guardians_relation_to_student])
            ->andFilterWhere(['like', 'guardians_occupation', $this->guardians_occupation])
            ->andFilterWhere(['like', 'guardians_employer', $this->guardians_employer])
            ->andFilterWhere(['like', 'previous_school_name', $this->previous_school_name])
            ->andFilterWhere(['like', 'previous_school_description', $this->previous_school_description])
            ->andFilterWhere(['like', 'previous_school_address', $this->previous_school_address])
            ->andFilterWhere(['like', 'previous_school_teacher_in_charge', $this->previous_school_teacher_in_charge])
            ->andFilterWhere(['like', 'previous_school_principal', $this->previous_school_principal]);

        return $dataProvider;
    }

    public function searchStudent($params)
    {
        $query = StudentForm::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['last_name' => SORT_ASC]],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'birth_date' => $this->birth_date,
            'zip_code' => $this->zip_code,
            'mobile' => $this->mobile,
            'phone' => $this->phone,
            'fathers_mobile' => $this->fathers_mobile,
            'fathers_phone' => $this->fathers_phone,
            'father_is' => $this->father_is,
            'mothers_mobile' => $this->mothers_mobile,
            'mothers_phone' => $this->mothers_phone,
            'mother_is' => $this->mother_is,
            'parents_are' => $this->parents_are,
            'guardians_phone' => $this->guardians_phone,
            'guardians_mobile' => $this->guardians_mobile,
            'student_is_living_with' => $this->student_is_living_with,
            'grade_level_id' => $this->grade_level_id,
            'previous_school_phone' => $this->previous_school_phone,
            'previous_school_mobile' => $this->previous_school_mobile,
            'previous_school_grade_level' => $this->previous_school_grade_level,
            'previous_school_average_grade' => $this->previous_school_average_grade,
            'from_school_year' => $this->from_school_year,
            'to_school_year' => $this->to_school_year,
            'student_has_sibling_enrolled' => $this->student_has_sibling_enrolled, 
            'student_photo'=> $this->student_photo,
            'guardians_photo' => $this->guardians_photo,
            'report_card' => $this->report_card,
            'good_moral' => $this->good_moral, 
            'birth_certificate' => $this->birth_certificate, 
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->orFilterWhere(['status' => 1])->orFilterWhere(['status' => 0]);

        $query->orderBy('last_name', 'asc');
        
        $query->andFilterWhere(['like', 'first_name', $this->first_name])
            ->andFilterWhere(['like', 'middle_name', $this->middle_name])
            ->andFilterWhere(['like', 'last_name', $this->last_name])
            ->andFilterWhere(['like', 'nickname', $this->nickname])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'religion', $this->religion])
            ->andFilterWhere(['like', 'citizenship', $this->citizenship])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'fathers_name', $this->fathers_name])
            ->andFilterWhere(['like', 'fathers_occupation', $this->fathers_occupation])
            ->andFilterWhere(['like', 'fathers_employer', $this->fathers_employer])
            ->andFilterWhere(['like', 'fathers_citizenship', $this->fathers_citizenship])
            ->andFilterWhere(['like', 'fathers_religion', $this->fathers_religion])
            ->andFilterWhere(['like', 'fathers_email', $this->fathers_email])
            ->andFilterWhere(['like', 'mothers_name', $this->mothers_name])
            ->andFilterWhere(['like', 'mothers_occupation', $this->mothers_occupation])
            ->andFilterWhere(['like', 'mothers_employer', $this->mothers_employer])
            ->andFilterWhere(['like', 'mothers_citizenship', $this->mothers_citizenship])
            ->andFilterWhere(['like', 'mothers_religion', $this->mothers_religion])
            ->andFilterWhere(['like', 'mothers_email', $this->mothers_email])
            ->andFilterWhere(['like', 'guardians_name', $this->guardians_name])
            ->andFilterWhere(['like', 'guardians_profile_image', $this->guardians_profile_image])
            ->andFilterWhere(['like', 'guardians_address', $this->guardians_address])
            ->andFilterWhere(['like', 'guardians_relation_to_student', $this->guardians_relation_to_student])
            ->andFilterWhere(['like', 'guardians_occupation', $this->guardians_occupation])
            ->andFilterWhere(['like', 'guardians_employer', $this->guardians_employer])
            ->andFilterWhere(['like', 'previous_school_name', $this->previous_school_name])
            ->andFilterWhere(['like', 'previous_school_description', $this->previous_school_description])
            ->andFilterWhere(['like', 'previous_school_address', $this->previous_school_address])
            ->andFilterWhere(['like', 'previous_school_teacher_in_charge', $this->previous_school_teacher_in_charge])
            ->andFilterWhere(['like', 'previous_school_principal', $this->previous_school_principal]);

        return $dataProvider;
    }
}

<?php
namespace app\models;

use app\rbac\models\AuthAssignment;
use app\rbac\models\AuthItem;
use yii\data\ActiveDataProvider;
use yii\base\Model;
use Yii;
   
/**
 * UserSearch represents the model behind the search form for app\models\User.
 */
class UserSearch extends User
{
    /**
     * Returns the validation rules for attributes.
     *
     * @return array
     */
    public function rules()
    {
        return [
            [['id', 'username', 'first_name', 'middle_name', 'last_name', 'email', 'status', 'item_name', 'role'], 'safe'],
        ];
    }

    /**
     * Returns a list of scenarios and the corresponding active attributes.
     *
     * @return array
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param  array $params
     * @return ActiveDataProvider
     */
    public function searchUser($params, $dev)
    {
        $query = User::find()->joinWith('role');
        $pageSize = Yii::$app->params['pageSize'];

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['created_at'=>SORT_DESC]],
            //'sort'=> ['defaultOrder' => ['username'=>SORT_ASC]],
            'pagination' => [
                'pageSize' => $pageSize,
            ]
        ]);

        // make item_name (Role) sortable
        $dataProvider->sort->attributes['item_name'] = [
            'asc' => ['item_name' => SORT_ASC],
            'desc' => ['item_name' => SORT_DESC],
        ];

        if (!($this->load($params) && $this->validate())) 
        {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'username', $this->username])
              ->andFilterWhere(['like', 'email', $this->email])
              ->andFilterWhere(['like', 'item_name', $this->item_name]);

        return $dataProvider;
    }

    public function searchTeacherList($params)
    {
        $query = User::find()->joinWith('role')->where(['item_name' => 'teacher']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['id'=>SORT_ASC]],
            'pagination' => [
                'pageSize' => $pageSize,
            ]
        ]);

        // make item_name (Role) sortable
        $dataProvider->sort->attributes['item_name'] = [
            'asc' => ['item_name' => SORT_ASC],
            'desc' => ['item_name' => SORT_DESC],
        ];

        if (!($this->load($params) && $this->validate())) 
        {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'username', $this->username])
              ->andFilterWhere(['like', 'email', $this->email])
              ->andFilterWhere(['like', 'item_name', $this->item_name]);

        return $dataProvider;
    }

    public function searchTeacher($params, $pageSize = 10, $role)
    {
        $query = User::find()->joinWith('role')->where(['item_name' => 'teacher']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['id'=>SORT_ASC]],
            'pagination' => [
                'pageSize' => $pageSize,
            ]
        ]);

        // make item_name (Role) sortable
        $dataProvider->sort->attributes['item_name'] = [
            'asc' => ['item_name' => SORT_ASC],
            'desc' => ['item_name' => SORT_DESC],
        ];

        if (!($this->load($params) && $this->validate())) 
        {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'username', $this->username])
              ->andFilterWhere(['like', 'email', $this->email])
              ->andFilterWhere(['like', 'item_name', $this->item_name]);

        return $dataProvider;
    }

    public function searchCashier($params, $pageSize = 10, $role)
    {
        $query = User::find()->joinWith('role')->where(['item_name' => 'cashier']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['id'=>SORT_ASC]],
            'pagination' => [
                'pageSize' => $pageSize,
            ]
        ]);

        // make item_name (Role) sortable
        $dataProvider->sort->attributes['item_name'] = [
            'asc' => ['item_name' => SORT_ASC],
            'desc' => ['item_name' => SORT_DESC],
        ];

        if (!($this->load($params) && $this->validate())) 
        {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'username', $this->username])
              ->andFilterWhere(['like', 'email', $this->email])
              ->andFilterWhere(['like', 'item_name', $this->item_name]);

        return $dataProvider;
    }
    
    public function searchStaff($params, $pageSize = 10, $role)
    {
        $query = User::find()->joinWith('role')
          ->where(['item_name' => 'staff']);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['id'=>SORT_ASC]],
            'pagination' => [
                'pageSize' => $pageSize,
            ]
        ]);

        // make item_name (Role) sortable
        $dataProvider->sort->attributes['item_name'] = [
            'asc' => ['item_name' => SORT_ASC],
            'desc' => ['item_name' => SORT_DESC],
        ];

        if (!($this->load($params) && $this->validate())) 
        {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'username', $this->username])
              ->andFilterWhere(['like', 'email', $this->email])
              ->andFilterWhere(['like', 'item_name', $this->item_name]);

        return $dataProvider;
    }
}

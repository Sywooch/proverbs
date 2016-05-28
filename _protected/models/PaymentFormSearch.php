<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PaymentForm;

/**
 * PaymentSearch represents the model behind the search form about `app\models\Payment`.
 */
class PaymentFormSearch extends PaymentForm
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'student_id', 'payment_description', 'transaction', 'created_at', 'updated_at'], 'integer'],
            [['paid_amount'], 'number'],
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

    public function searchPayment($params)
    {
        $pageSize = Yii::$app->params['pageSize'];

        $query = PaymentForm::find();



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
            'student_id' => $this->student_id,
            'payment_description' => $this->payment_description,
            'transaction' => $this->transaction,
            'paid_amount' => $this->paid_amount
        ]);

        return $dataProvider;
    }
}

<?php

namespace frontend\modules\data\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\modules\data\models\Checkout;

/**
 * CheckoutSearch represents the model behind the search form of `frontend\modules\data\models\Checkout`.
 */
class CheckoutSearch extends Checkout
{
    public $shopTitle;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'shop_id', 'date_pay', 'createdAt', 'updatedAt'], 'integer'],
            [['comment'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Checkout::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'shop_id' => $this->shop_id,
            'date_pay' => $this->date_pay,
            'createdAt' => $this->createdAt,
            'updatedAt' => $this->updatedAt,
        ]);

        $query->andFilterWhere(['ilike', 'comment', $this->comment]);
        $query->andFilterWhere(['ilike', 'comment', $this->comment]);

        return $dataProvider;
    }
}

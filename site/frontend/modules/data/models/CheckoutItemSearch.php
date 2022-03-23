<?php

namespace frontend\modules\data\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\modules\data\models\CheckoutItem;

/**
 * CheckoutItemSearch represents the model behind the search form of `frontend\modules\data\models\CheckoutItem`.
 */
class CheckoutItemSearch extends CheckoutItem
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'product_id', 'checkout_id', 'discountPercent', 'discountAbsolute'], 'integer'],
            [['priceUnit', 'priceItem', 'amountUnit'], 'number'],
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
        $query = CheckoutItem::find();

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
            'product_id' => $this->product_id,
            'checkout_id' => $this->checkout_id,
            'priceUnit' => $this->priceUnit,
            'priceItem' => $this->priceItem,
            'amountUnit' => $this->amountUnit,
            'discountPercent' => $this->discountPercent,
            'discountAbsolute' => $this->discountAbsolute,
        ]);

        return $dataProvider;
    }
}

<?php

namespace frontend\modules\data\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\modules\data\models\Currency;

/**
 * CurrencySearch represents the model behind the search form of `frontend\modules\data\models\Currency`.
 */
class CurrencySearch extends Currency
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'createdAt', 'updatedAt'], 'integer'],
            [['title', 'suffix', 'symbolClass'], 'safe'],
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
        $query = Currency::find();

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
            'createdAt' => $this->createdAt,
            'updatedAt' => $this->updatedAt,
        ]);

        $query->andFilterWhere(['ilike', 'title', $this->title])
            ->andFilterWhere(['ilike', 'suffix', $this->suffix])
            ->andFilterWhere(['ilike', 'symbolClass', $this->symbolClass]);

        return $dataProvider;
    }
}

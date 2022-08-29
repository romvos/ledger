<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "shop".
 *
 * @property int $id
 * @property int|null $currency_id Валюта магазина
 * @property string $title
 * @property int|null $createdAt
 * @property int|null $updatedAt
 * @property string|null $description
 *
 * @property Checkout[] $checkouts
 * @property Currency $currency
 */
class Shop extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'shop';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['currency_id', 'createdAt', 'updatedAt'], 'default', 'value' => null],
            [['currency_id', 'createdAt', 'updatedAt'], 'integer'],
            [['title'], 'required'],
            [['description'], 'string'],
            [['title'], 'string', 'max' => 250],
            [['currency_id'], 'exist', 'skipOnError' => true, 'targetClass' => Currency::className(), 'targetAttribute' => ['currency_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'currency_id' => 'Currency ID',
            'title' => 'Title',
            'createdAt' => 'Created At',
            'updatedAt' => 'Updated At',
            'description' => 'Description',
        ];
    }

    /**
     * Gets query for [[Checkouts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCheckouts()
    {
        return $this->hasMany(Checkout::className(), ['shop_id' => 'id']);
    }

    /**
     * Gets query for [[Currency]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCurrency()
    {
        return $this->hasOne(Currency::className(), ['id' => 'currency_id']);
    }
}

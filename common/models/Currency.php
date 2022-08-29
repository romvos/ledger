<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "currency".
 *
 * @property int $id
 * @property string $title название валюты
 * @property string $suffix суффикс валюты
 * @property string|null $symbolClass font awesome класс
 * @property int|null $createdAt
 * @property int|null $updatedAt
 *
 * @property Shop[] $shops
 */
class Currency extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'currency';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'suffix'], 'required'],
            [['createdAt', 'updatedAt'], 'default', 'value' => null],
            [['createdAt', 'updatedAt'], 'integer'],
            [['title'], 'string', 'max' => 50],
            [['suffix', 'symbolClass'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'suffix' => 'Suffix',
            'symbolClass' => 'Symbol Class',
            'createdAt' => 'Created At',
            'updatedAt' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Shops]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getShops()
    {
        return $this->hasMany(Shop::className(), ['currency_id' => 'id']);
    }
}

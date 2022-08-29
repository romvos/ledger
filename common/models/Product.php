<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property int|null $weightNet вес Нетто
 * @property int|null $weightGross вес Брутто
 * @property int|null $createdAt
 * @property int|null $updatedAt
 * @property string $measureSuffix суффикс единиц измерения
 * @property string $title название товара
 * @property string|null $description
 * @property string|null $comment
 *
 * @property CheckoutItem[] $checkoutItems
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['weightNet', 'weightGross', 'createdAt', 'updatedAt'], 'default', 'value' => null],
            [['weightNet', 'weightGross', 'createdAt', 'updatedAt'], 'integer'],
            [['measureSuffix', 'title'], 'required'],
            [['description', 'comment'], 'string'],
            [['measureSuffix'], 'string', 'max' => 10],
            [['title'], 'string', 'max' => 300],
            [['title'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'weightNet' => 'Weight Net',
            'weightGross' => 'Weight Gross',
            'createdAt' => 'Created At',
            'updatedAt' => 'Updated At',
            'measureSuffix' => 'Measure Suffix',
            'title' => 'Title',
            'description' => 'Description',
            'comment' => 'Comment',
        ];
    }

    /**
     * Gets query for [[CheckoutItems]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCheckoutItems()
    {
        return $this->hasMany(CheckoutItem::className(), ['product_id' => 'id']);
    }
}

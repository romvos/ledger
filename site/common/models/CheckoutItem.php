<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "checkoutItem".
 *
 * @property int $id
 * @property int $product_id
 * @property int $checkout_id
 * @property float $priceUnit
 * @property float $priceItem
 * @property float $amountUnit
 * @property int|null $discountPercent
 * @property int|null $discountAbsolute
 *
 * @property Checkout $checkout
 * @property Product $product
 */
class CheckoutItem extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'checkoutItem';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_id', 'checkout_id', 'priceUnit', 'priceItem', 'amountUnit'], 'required'],
            [['product_id', 'checkout_id', 'discountPercent', 'discountAbsolute'], 'default', 'value' => null],
            [['product_id', 'checkout_id', 'discountPercent', 'discountAbsolute'], 'integer'],
            [['priceUnit', 'priceItem', 'amountUnit'], 'number'],
            [['checkout_id'], 'exist', 'skipOnError' => true, 'targetClass' => Checkout::className(), 'targetAttribute' => ['checkout_id' => 'id']],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_id' => 'Product ID',
            'checkout_id' => 'Checkout ID',
            'priceUnit' => 'Price Unit',
            'priceItem' => 'Price Item',
            'amountUnit' => 'Amount Unit',
            'discountPercent' => 'Discount Percent',
            'discountAbsolute' => 'Discount Absolute',
        ];
    }

    /**
     * Gets query for [[Checkout]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCheckout()
    {
        return $this->hasOne(Checkout::className(), ['id' => 'checkout_id']);
    }

    /**
     * Gets query for [[Product]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }
}

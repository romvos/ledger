<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "checkout".
 *
 * @property int $id
 * @property int $shop_id
 * @property int|null $date_pay
 * @property int|null $createdAt
 * @property int|null $updatedAt
 * @property string|null $comment
 *
 * @property CheckoutItem[] $checkoutItems
 * @property Shop $shop
 */
class Checkout extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'checkout';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['shop_id'], 'required'],
            [['shop_id', 'date_pay', 'createdAt', 'updatedAt'], 'default', 'value' => null],
            [['shop_id', 'date_pay', 'createdAt', 'updatedAt'], 'integer'],
            [['comment'], 'string'],
            [['shop_id'], 'exist', 'skipOnError' => true, 'targetClass' => Shop::className(), 'targetAttribute' => ['shop_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'shop_id' => 'Shop ID',
            'date_pay' => 'Date Pay',
            'createdAt' => 'Created At',
            'updatedAt' => 'Updated At',
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
        return $this->hasMany(CheckoutItem::className(), ['checkout_id' => 'id']);
    }

    /**
     * Gets query for [[Shop]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getShop()
    {
        return $this->hasOne(Shop::className(), ['id' => 'shop_id']);
    }
}

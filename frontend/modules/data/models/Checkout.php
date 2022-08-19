<?php

namespace frontend\modules\data\models;

use common\models\Checkout as BaseModel;
use frontend\modules\data\forms\FormCheckoutItem;
use yii\db\ActiveQuery;
use yii\db\Exception;

class Checkout extends BaseModel
{
    /**
     * @param FormCheckoutItem $form
     * @return void
     * @throws Exception
     */
    public function addItem(FormCheckoutItem $form)
    {
        $checkoutItem = new CheckoutItem([
            'checkout_id' => $this->id,
            'product_id' => (int)$form->product_id,
            'priceUnit' => (float)$form->priceUnit,
            'amountUnit' => (float)$form->amountUnit,
            'discountPercent' => (float)$form->discountPercent,
            'discountAbsolute' => (float)$form->discountAbsolute,
        ]);

        if (!$checkoutItem->validate()) {
            throw new Exception('Invalid data', $checkoutItem->getErrors());
        }

        if (!$checkoutItem->save()) {
            throw new Exception('Saving failed', $checkoutItem->getErrors());
        }
    }

    /**
     * @return ActiveQuery
     */
    public function getShop()
    {
        return $this->hasOne(Shop::class, ['id' => 'shop_id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getCheckoutItems()
    {
        return $this->hasMany(CheckoutItem::class, ['checkout_id' => 'id']);
    }
}

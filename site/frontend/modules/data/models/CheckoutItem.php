<?php

namespace frontend\modules\data\models;

use common\models\CheckoutItem as BaseModel;
use yii\db\ActiveQuery;

class CheckoutItem extends BaseModel
{
    /**
     * @return ActiveQuery
     */
    public function getCheckout()
    {
        return $this->hasOne(Checkout::class, ['id' => 'checkout_id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::class, ['id' => 'product_id']);
    }
}

<?php

namespace frontend\modules\data\models;

use common\models\CheckoutItem as BaseModel;
use yii\db\ActiveQuery;

class CheckoutItem extends BaseModel
{
    /**
     * @param $runValidation
     * @param $attributeNames
     * @return bool
     */
    public function save($runValidation = true, $attributeNames = null): bool
    {
        if ($this->getIsNewRecord()) {
            $this->calculatePriceItem();
            $result = parent::save($runValidation, $attributeNames);
        } else {
            $result = parent::save($runValidation, $attributeNames) !== false;
        }

        return $result;
    }

    /**
     * @return float
     */
    public function calculatePriceItem()
    {
        $discountAmountPercent = $this->discountPercent && !$this->discountAbsolute
            ? $this->priceUnit / 100 * $this->discountPercent
            : 0;

        $priceUnit = $this->priceUnit - $discountAmountPercent - $this->discountAbsolute;
        $this->priceItem = $this->amountUnit * $priceUnit;

        return $this->priceItem;
    }

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

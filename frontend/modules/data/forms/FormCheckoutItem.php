<?php

namespace frontend\modules\data\forms;

use frontend\modules\data\models\Checkout;
use frontend\modules\data\models\Product;
use yii\base\Model;

class FormCheckoutItem extends Model
{
    public $product_id;
    public $checkout_id;
    public $priceUnit;
    public $amountUnit;
    public $discountPercent;
    public $discountAbsolute;

    /**
     * @return array
     */
    public function rules()
    {
        return [
            [['product_id', 'checkout_id', 'priceUnit', 'amountUnit'], 'required'],
            [['product_id', 'checkout_id'], 'integer'],
            [['priceUnit', 'amountUnit', 'discountPercent', 'discountAbsolute'], 'number'],
            [['priceUnit', 'amountUnit'], 'compare', 'compareValue' => 0, 'operator' => '>'],
            [['checkout_id'], 'exist', 'skipOnError' => true, 'targetClass' => Checkout::class, 'targetAttribute' => ['checkout_id' => 'id']],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::class, 'targetAttribute' => ['product_id' => 'id']],
        ];
    }
}

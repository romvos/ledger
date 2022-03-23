<?php

namespace frontend\modules\data\models;

use common\models\Checkout as BaseModel;
use yii\db\ActiveQuery;

class Checkout extends BaseModel
{
    /**
     * @return ActiveQuery
     */
    public function getShop()
    {
        return $this->hasOne(Shop::class, ['id' => 'shop_id']);
    }
}

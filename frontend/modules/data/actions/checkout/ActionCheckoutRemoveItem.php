<?php

namespace frontend\modules\data\actions\checkout;

use frontend\modules\data\models\CheckoutItem;
use yii\base\Action;
use yii\web\BadRequestHttpException;
use yii\web\NotFoundHttpException;

class ActionCheckoutRemoveItem extends Action
{
    public function run($id)
    {
        if (empty($id) || !is_numeric($id)) {
            throw new BadRequestHttpException('ID has invalid format');
        }

        $checkoutItem = CheckoutItem::findOne($id);
        if (!$checkoutItem) {
            throw new NotFoundHttpException('Checkout Item not found');
        }

        $checkoutItem->delete();
    }
}

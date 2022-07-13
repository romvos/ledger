<?php

namespace frontend\modules\data\actions\checkout;

use frontend\modules\data\forms\FormCheckoutItem;
use frontend\modules\data\models\Checkout;
use Yii;
use yii\base\Action;
use yii\web\BadRequestHttpException;
use yii\web\NotFoundHttpException;

class ActionCheckoutFillingForm extends Action
{
    public function run(int $checkoutId)
    {
        if (empty($checkoutId) || !is_numeric($checkoutId)) {
            throw new BadRequestHttpException('некорректный ID чека: ' . print_r($checkoutId, true));
        }

        $checkout = Checkout::find()
            ->where(['id' => $checkoutId])
            ->with(['shop', 'checkoutItems', 'checkoutItems.product'])
            ->one();

        if (!$checkout) {
            throw new NotFoundHttpException("чек {$checkoutId} не найден");
        }

        $formCheckoutItem = new FormCheckoutItem([
            'checkout_id' => $checkout->id,
        ]);

        return $this->controller->render('fill', [
            'checkout' => $checkout,
            'formCheckoutItem' => $formCheckoutItem,
        ]);
    }
}

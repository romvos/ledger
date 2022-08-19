<?php

namespace frontend\modules\data\actions\checkout;

use frontend\modules\data\models\Checkout;
use frontend\modules\data\models\Shop;
use yii\base\Action;
use yii\db\Exception;
use yii\web\BadRequestHttpException;
use yii\web\NotFoundHttpException;
use yii\web\ServerErrorHttpException;

class ActionCheckoutCreateByShop extends Action
{
    public function run($shopId = null)
    {
        if (empty($shopId) || !ctype_digit($shopId)) {
            throw new BadRequestHttpException('ID магазина обязателен');
        }

        $shop = Shop::find()
            ->where(['id' => (int)$shopId])
            ->one();

        if (!$shop) {
            throw new NotFoundHttpException("магазин {$shopId} не найден");
        }

        $checkout = new Checkout([
            'shop_id' => $shop->id,
            'createdAt' => time(),
        ]);

        if (!$checkout->validate()) {
            throw new Exception('недопустимые параметры', $checkout->getErrors());
        }

        if ($checkout->save()) {
            $this->controller->redirect(['/data/checkout/filling-form', 'checkoutId' => $checkout->id]);
        } else {
            throw new ServerErrorHttpException('сохранение чека вызвало ошибку');
        }
    }
}
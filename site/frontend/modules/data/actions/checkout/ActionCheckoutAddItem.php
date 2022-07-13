<?php

namespace frontend\modules\data\actions\checkout;

use frontend\modules\data\forms\FormCheckoutItem;
use frontend\modules\data\models\Checkout;
use Yii;
use Throwable;
use yii\base\Action;
use yii\db\Exception;
use yii\web\BadRequestHttpException;
use yii\web\NotFoundHttpException;

class ActionCheckoutAddItem extends Action
{
    /**
     * @return void
     * @throws Exception
     * @throws NotFoundHttpException
     */
    public function run()
    {
        $form = new FormCheckoutItem();
        $paramsPost = Yii::$app->request->post();

        if (!$form->load($paramsPost)) {
            throw new Exception('не удалось загрузить форму', $paramsPost);
        }

        if (!$form->validate()) {
            throw new Exception('форма содержит невалидные данные', $form->getErrors());
        }

        /** @var ?Checkout $checkout */
        $checkout = Checkout::find()
            ->where(['id' => $form->checkout_id])
            ->with(['checkoutItems'])
            ->one();

        if (!$checkout) {
            throw new NotFoundHttpException("чек {$form->checkout_id} не найден");
        }

        $checkout->addItem($form);
    }
}

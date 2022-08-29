<?php

namespace frontend\modules\data\actions\checkout;


use frontend\modules\data\models\Checkout;
use yii\base\Action;
use yii\web\NotFoundHttpException;

class ActionCheckoutListItems extends Action
{
    /**
     * @param $id
     *
     * @return string
     * @throws NotFoundHttpException
     */
    public function run($id)
    {
        $checkout = Checkout::find()
            ->with('checkoutItems')
            ->where(['id' => $id])
            ->one();

        if (empty($checkout)) {
            throw new NotFoundHttpException("$id");
        }

        return $this->controller->render('list-items', [
            'checkout' => $checkout,
        ]);
    }

}

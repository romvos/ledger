<?php

use frontend\modules\data\models\Checkout;
use frontend\modules\data\models\CheckoutItem;
use frontend\modules\data\forms\FormCheckoutItem;
use yii\web\View;
use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\web\JsExpression;
use frontend\modules\data\assets\checkout\AssetBundleCheckoutFill;

/**
 * @var View $this
 * @var Checkout $checkout
 * @var FormCheckoutItem $formCheckoutItem
 */

AssetBundleCheckoutFill::register($this);

$this->title = 'Чек: заполнение';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="checkout-index">

    <div class="row">
        <h2>
            <span>
                <?= $checkout->shop->title ?>,
            </span>
            <?= Html::encode($this->title); ?>

        </h2>

    </div>

    <div class="row">

        <div class="container-form col-md-4">
            <h2>
                Добавить покупку:
            </h2>
            <?php $form = ActiveForm::begin([
                    'id' => 'form-checkout-item',
            ]); ?>

            <?= $form->field($formCheckoutItem, 'checkout_id')->hiddenInput()->label(false) ?>

            <?= $form->field($formCheckoutItem, 'product_id')->widget(Select2::class, [
                'data' => [],
                'options' => [
                    'id' => 'select2-product_id',
                    'placeholder' => 'Выбери товар ...',
                ],
                'pluginOptions' => [
                    'allowClear' => false,
                    'minimumInputLength' => 3,
                    'language' => [
                        'errorLoading' => new JsExpression("function () { return 'Ищем похожие ...'; }"),
                    ],
                    'ajax' => [
                        'url' => '/data/product/search',
                        'dataType' => 'json',
                        'data' => new JsExpression('function(params) { return {title:params.term}; }')
                    ],
                    'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
                    'templateResult' => new JsExpression('function(product) { return product.title; }'),
                    'templateSelection' => new JsExpression('function (product) { return product.title; }'),
                ],
            ])?>

            <?= $form->field($formCheckoutItem, 'priceUnit')->textInput() ?>

            <?= $form->field($formCheckoutItem, 'amountUnit')->textInput() ?>

            <?= $form->field($formCheckoutItem, 'discountPercent')->textInput() ?>

            <?= $form->field($formCheckoutItem, 'discountAbsolute')->textInput() ?>

            <div class="form-group">
                <?= Html::button('Добавить', [
                    'id' => 'action-add-checkout-item',
                    'class' => 'btn btn-success'
                ]) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>

        <div class="container-list col-md-8">
            <h2>
                Cписок покупок:
            </h2>

            <?php Pjax::begin(['id' => 'pjax-checkout-item-list']) ?>
            <ul >
                <li class="row">
                    <span class="col-md-6">Товар:</span>
                    <span class="col-md-1">Кол-во:</span>
                    <span class="col-md-3">За единицу:</span>
                    <span class="col-md-2">За позицию:</span>
                </li>
                <div class="ul-checkout-item-list" style="height: 200px; overflow-x: auto;">
                <?php
                    /** @var CheckoutItem $checkoutItem */
                foreach ($checkout->checkoutItems ?? [] as $checkoutItem) { ?>
                    <li class="row">
                        <span class="col-md-1">
                            <button class="action-remove-checkout-item btn btn-danger btn-sm"
                                    data-id="<?= $checkoutItem->id ?>"
                                    style="height: 20px;">
                                -
                            </button>
                        </span>
                        <span class="col-md-5">
                            <?php
                                $title = mb_strlen($checkoutItem->product->title) > 30
                                    ? mb_substr($checkoutItem->product->title, 0, 47) . '...'
                                    : $checkoutItem->product->title;
                            ?>
                            <?= htmlentities($title) ?>
                        </span>
                        <span class="col-md-1">
                            <?= $checkoutItem->amountUnit ?>
                        </span>
                        <span class="col-md-3">
                            <?php
                                $discount = '';
                                if ($checkoutItem->discountPercent) {
                                    $discount = implode('', [
                                        "\t -",
                                        $checkoutItem->discountPercent,
                                        '%',
                                    ]);
                                }

                                if (empty($discount) && $checkoutItem->discountAbsolute) {
                                    $discount = "\t -" . $checkoutItem->discountAbsolute;
                                }
                            ?>
                            <?= number_format($checkoutItem->priceUnit, 2) . $discount ?>
                        </span>
                        <span class="col-md-2">
                            <?= number_format($checkoutItem->priceItem, 2) ?>
                        </span>
                    </li>
                <?php } ?>
                </div>
            </ul>
            <?php Pjax::end(); ?>

        </div>
    </div>

</div>
<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\modules\data\models\CheckoutItemSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="checkout-item-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'product_id') ?>

    <?= $form->field($model, 'checkout_id') ?>

    <?= $form->field($model, 'priceUnit') ?>

    <?= $form->field($model, 'priceItem') ?>

    <?php // echo $form->field($model, 'amountUnit') ?>

    <?php // echo $form->field($model, 'discountPercent') ?>

    <?php // echo $form->field($model, 'discountAbsolute') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

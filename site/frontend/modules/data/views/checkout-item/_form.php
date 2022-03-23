<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\modules\data\models\CheckoutItem */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="checkout-item-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'product_id')->textInput() ?>

    <?= $form->field($model, 'checkout_id')->textInput() ?>

    <?= $form->field($model, 'priceUnit')->textInput() ?>

    <?= $form->field($model, 'priceItem')->textInput() ?>

    <?= $form->field($model, 'amountUnit')->textInput() ?>

    <?= $form->field($model, 'discountPercent')->textInput() ?>

    <?= $form->field($model, 'discountAbsolute')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

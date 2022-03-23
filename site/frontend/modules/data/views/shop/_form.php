<?php

use frontend\modules\data\models\Shop;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\web\View;

/**
 * @var View $this
 * @var Shop $model
 * @var ActiveForm $form
 * @var array $optionsCurrency
*/
?>

<div class="shop-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'currency_id')->dropDownList($optionsCurrency) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

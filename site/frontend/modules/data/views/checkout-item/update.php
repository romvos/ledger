<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\data\models\CheckoutItem */

$this->title = 'Update Checkout Item: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Checkout Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="checkout-item-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

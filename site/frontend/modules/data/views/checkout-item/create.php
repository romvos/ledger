<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\data\models\CheckoutItem */

$this->title = 'Create Checkout Item';
$this->params['breadcrumbs'][] = ['label' => 'Checkout Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="checkout-item-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\data\models\Shop */

$this->title = 'Update Shop: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Shops', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="shop-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

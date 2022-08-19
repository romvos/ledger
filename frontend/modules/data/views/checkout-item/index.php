<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\data\models\CheckoutItemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Checkout Items';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="checkout-item-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Checkout Item', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'product_id',
            'checkout_id',
            'priceUnit',
            'priceItem',
            //'amountUnit',
            //'discountPercent',
            //'discountAbsolute',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, CheckoutItem $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>

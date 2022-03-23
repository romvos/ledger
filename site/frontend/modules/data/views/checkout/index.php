<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\data\models\CheckoutSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Checkouts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="checkout-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Checkout', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'shop_id',
            'date_pay',
            'createdAt',
            'updatedAt',
            //'comment:ntext',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Checkout $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>

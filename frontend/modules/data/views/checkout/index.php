<?php

use frontend\modules\data\models\Checkout;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\web\JsExpression;
use kartik\select2\Select2;
use frontend\modules\data\assets\checkout\AssetBundleCheckoutIndex;

/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\data\models\CheckoutSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

AssetBundleCheckoutIndex::register($this);

$this->title = 'Checkouts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="checkout-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <div>
        <div class="row">
            <div class="col-md-6">
                <?= Select2::widget([
                    'name' => 'shopId',
                    'data' => [],
                    'options' => [
                        'id' => 'shopId',
                        'placeholder' => 'Выбери магазин ...',
                    ],
                    'pluginOptions' => [
                        'allowClear' => false,
                        'minimumInputLength' => 3,
                        'language' => [
                            'errorLoading' => new JsExpression("function () { return 'Ищем похожие ...'; }"),
                        ],
                        'ajax' => [
                            'url' => '/data/shop/search',
                            'dataType' => 'json',
                            'data' => new JsExpression('function(params) { return {title:params.term}; }')
                        ],
                        'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
                        'templateResult' => new JsExpression('function(shop) { return shop.text; }'),
                        'templateSelection' => new JsExpression('function (shop) { return shop.text; }'),
                    ],
                ]); ?>
            </div>

            <div class="col-md-4">
                <?= Html::button('Добавить чек', [
                    'id' => 'action-create-checkout',
                    'class' => 'btn btn-success',
                ]) ?>
            </div>
        </div>
        <hr>
    </div>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'shop_id',
                'format' => 'raw',
                /** @var \frontend\modules\data\models\Checkout $checkout */
                'value' => function ($checkout) {
                    return Html::a(htmlentities($checkout->shop->title), [
                        '/data/shop/view', 'id' => $checkout->shop->id,
                    ]);
                }
            ],
            'comment',
            'date_pay',
            'createdAt:datetime',
            'updatedAt:datetime',
            //'comment:ntext',
            [
                'format' => 'raw',
                'value' => function ($checkout) {
                    $url = Url::to(["/data/checkout/list-items/{$checkout->id}"]);
                    $icon = '<svg aria-hidden="true" style="display:inline-block;font-size:inherit;height:1em;overflow:visible;vertical-align:-.125em;width:1.125em" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path fill="currentColor" d="M573 241C518 136 411 64 288 64S58 136 3 241a32 32 0 000 30c55 105 162 177 285 177s230-72 285-177a32 32 0 000-30zM288 400a144 144 0 11144-144 144 144 0 01-144 144zm0-240a95 95 0 00-25 4 48 48 0 01-67 67 96 96 0 1092-71z"/></svg>';
                    return Html::a($icon, $url, []);
                }
            ],
            [
                'class' => ActionColumn::class,
//                'urlCreator' => function ($action, (\common\models\Checkout)$model, $key, $index, $column) {
//                    return Url::toRoute([$action, 'id' => $model->id]);
//                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>

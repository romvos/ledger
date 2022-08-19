<?php

use frontend\modules\data\models\Currency;
use frontend\modules\data\models\CurrencySearch;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\web\View;
use yii\data\ActiveDataProvider;

/**
 * @var View $this
 * @var CurrencySearch $searchModel
 * @var ActiveDataProvider $dataProvider
 */

$this->title = 'Currencies';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="currency-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'title',
            'suffix',
            'symbolClass',
            'createdAt:datetime',
            'updatedAt:datetime',
            [
                'class' => ActionColumn::class,
                'urlCreator' => function ($action, Currency $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>

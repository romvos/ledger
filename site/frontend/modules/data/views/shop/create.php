<?php

use yii\helpers\Html;
use yii\web\View;
use frontend\modules\data\models\Shop;


/**
 * @var array $optionsCurrency
 * @var Shop $model
 */

$this->title = 'Create Shop';
$this->params['breadcrumbs'][] = ['label' => 'Shops', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="shop-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'optionsCurrency' => $optionsCurrency,
    ]) ?>

</div>

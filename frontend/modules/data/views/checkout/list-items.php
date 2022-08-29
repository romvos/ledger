<?php

use frontend\modules\data\models\CheckoutItem;
use frontend\modules\data\models\Checkout;
use yii\web\View;

/**
 * @var View $this
 * @var Checkout $checkout
 */

?>

<div class="row">
    <div class="container col-md-12">
        <p class="row">
            <span class="col-md-6">Товар:</span>
            <span class="col-md-1">Кол-во:</span>
            <span class="col-md-3">За единицу:</span>
            <span class="col-md-2">За позицию:</span>
        </p>

        <ul class="ul-checkout-item-list row"
            style="height: 200px; overflow-y: hidden;">
        <?php
            /** @var CheckoutItem $checkoutItem */
            foreach ($checkout->checkoutItems ?? [] as $checkoutItem) {
        ?>
            <li class="row">
                <span class="col-md-1"></span>
                <span class="col-md-5" title="<?= $checkoutItem->product->title ?>">
                    <?php
                        $title = mb_strlen($checkoutItem->product->title) > 30
                            ? mb_substr($checkoutItem->product->title, 0, 27) . '...'
                            : $checkoutItem->product->title;
                    ?>
                    <?= htmlentities($title) ?>
                </span>
                <span class="col-md-1">
                    <?= $checkoutItem->amountUnit ?>
                </span>
                <span class="col-md-3">
                <?php
                    $discountItems = [];
                    if ($checkoutItem->discountPercent) {
                        $discountItems = [
                            "\t -",
                            $checkoutItem->discountPercent,
                            '%',
                        ];
                    } elseif ($checkoutItem->discountAbsolute) {
                        $discountItems = [
                            "\t -",
                            $checkoutItem->discountAbsolute,
                        ];
                    }
                ?>
                    <?= number_format($checkoutItem->priceUnit, 2) . implode('', $discountItems) ?>
                </span>
                <span class="col-md-2">
                    <?= number_format($checkoutItem->priceItem, 2) ?>
                </span>
            </li>
        <?php } ?>
        </ul>
    </div>
</div>

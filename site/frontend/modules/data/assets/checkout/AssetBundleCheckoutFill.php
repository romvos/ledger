<?php

namespace frontend\modules\data\assets\checkout;

use frontend\assets\AppAsset;
use yii\web\AssetBundle;

class AssetBundleCheckoutFill extends AssetBundle
{
    public $sourcePath = '@frontend/modules/data/assets/checkout/js';
    public $js = [
        'fill.js',
    ];

    public $depends = [
        AppAsset::class,
    ];
}

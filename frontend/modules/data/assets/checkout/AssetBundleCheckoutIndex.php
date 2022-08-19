<?php

namespace frontend\modules\data\assets\checkout;

use frontend\assets\AppAsset;
use yii\web\AssetBundle;

class AssetBundleCheckoutIndex extends AssetBundle
{
    public $sourcePath = '@frontend/modules/data/assets/checkout/js';
    public $js = [
        'index.js',
    ];

    public $depends = [
        AppAsset::class,
    ];
}

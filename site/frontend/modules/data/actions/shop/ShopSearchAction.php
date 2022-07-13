<?php

namespace frontend\modules\data\actions\shop;

use common\models\Shop;
use Yii;
use yii\base\Action;
use yii\web\BadRequestHttpException;
use yii\web\Response;

class ShopSearchAction extends Action
{
    /**
     * @return array|\yii\db\ActiveRecord[]
     * @throws BadRequestHttpException
     */
    public function run()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $title = Yii::$app->request->get('title');
        if (empty($title)) {
            throw new BadRequestHttpException('title is required');
        }

        $listShop = Shop::find()
            ->select(['id', 'text' => 'title'])
            ->asArray()
            ->where(['ilike', 'title', $title])
            ->limit(10)
            ->orderBy(['title' => SORT_ASC])
            ->all();

        return ['results' => $listShop];
    }
}

<?php

namespace frontend\modules\data\actions\product;


use frontend\modules\data\models\Product;
use Yii;
use yii\base\Action;
use yii\web\BadRequestHttpException;
use yii\web\Response;

class ActionProductSearch extends Action
{
    /**
     * @return array
     * @throws BadRequestHttpException
     */
    public function run()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $title = Yii::$app->request->get('title');
        if (empty($title)) {
            throw new BadRequestHttpException('title is required');
        }

        $listProducts = Product::find()
            ->select(['id', 'title'])
            ->asArray()
            ->where(['ilike', 'title', $title])
            ->limit(10)
            ->orderBy(['title' => SORT_ASC])
            ->all();

        return ['results' => $listProducts];
    }
}
<?php
/**
 * @name: SailShop System
 * @author: 游梦惊园
 * @link: https://github.com/duanbiaowu/sailshop
 * @blog: http://www.cnblogs.com/duanbiaowu
 * @copyright: Copyright (c) 2016 SailShop System
 * @date: 2015-11-06
 */

namespace backend\controllers\system;

use Yii;
use backend\models\system\Area;
use yii\web\Controller;

class AreaController extends Controller
{
    public function actionIndex()
    {
        $provinces = Area::find()
            ->where(['parent_id' => 0])
            ->asArray()
            ->all();

        return $this->render('index', [
            'provinces' => $provinces,
        ]);
    }

    public function actionView($pid)
    {
        if (null === ($model = Area::findOne($pid))) {
            return $this->renderPartial('/site/error');
        }

        $cities = Area::find()
            ->where(['parent_id' => $model->id])
            ->asArray()
            ->all();

        foreach ($cities as &$city) {
            $city['districts'] = Area::find()
                ->where(['parent_id' => $city['id']])
                ->asArray()
                ->all();
        }

        return $this->renderPartial('view', [
            'model' => $model,
            'cities' => $cities,
        ]);
    }
}
<?php
/**
 * @name Launch shop system
 * @copyright Copyright (c) 2015-2099
 * @author: 游梦惊园
 * @blog: www.codean.net
 * @version 1.0
 * @date: 2015-11-06
 */

namespace backend\controllers\system;

use yii\web\Controller;

class ExpressController extends Controller
{
    public function actionIndex()
    {
        return $this->render('/system/pay/express');
    }
}
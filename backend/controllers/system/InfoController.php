<?php
/**
 * @name Launch shop system
 * @copyright Copyright (c) 2015-2099
 * @author: 游梦惊园
 * @blog: www.codean.net
 * @version 1.0
 * @date: 2015-12-15
 */

namespace backend\controllers\system;

use Yii;
use yii\web\Controller;

class InfoController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
}
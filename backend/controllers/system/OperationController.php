<?php
/**
 * @name Launch Shop System
 * @copyright Copyright (c) 2015-2099
 * @author: 游梦惊园
 * @blog: http://www.cnblogs.com/duanbiaowu/
 * @version 1.0
 * @date: 2015-12-17
 */

namespace backend\controllers\system;

use Yii;
use yii\base\Controller;

class OperationController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
}
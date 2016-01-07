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
use yii\web\Controller;

class AreaController extends Controller
{
    public function actionIndex()
    {
        return $this->render('/system/pay/area');
    }
}
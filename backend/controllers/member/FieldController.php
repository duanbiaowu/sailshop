<?php
/**
 * @name: SailShop System
 * @author: 游梦惊园
 * @link: https://github.com/duanbiaowu/sailshop
 * @blog: http://www.cnblogs.com/duanbiaowu
 * @copyright: Copyright (c) 2016 SailShop System
 * @date: 2015-11-10
 */

namespace backend\controllers\member;

use Yii;
use yii\web\Controller;

class FieldController extends Controller
{
    public function actionIndex()
    {
        return $this->render('/member/member/field');
    }
}
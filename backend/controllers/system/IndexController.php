<?php
/**
 * @name: SailShop System
 * @author: 游梦惊园
 * @link: https://github.com/duanbiaowu/sailshop
 * @blog: http://www.cnblogs.com/duanbiaowu
 * @copyright: Copyright (c) 2016 SailShop System
 * @date: 2015-10-26
 */

namespace backend\controllers\system;

use Yii;
use yii\web\Controller;

class IndexController extends Controller
{
    public function actionIndex()
    {
        $mysqlVersion = Yii::$app->db->createCommand('SELECT VERSION();')->queryColumn();
        return $this->render('/system/system/index', [
            'mysqlVersion' => $mysqlVersion,
        ]);
    }
}
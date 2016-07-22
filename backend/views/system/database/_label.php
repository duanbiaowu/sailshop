<?php
/**
 * @name: SailShop System
 * @author: 游梦惊园
 * @link: https://github.com/duanbiaowu/sailshop
 * @blog: http://www.cnblogs.com/duanbiaowu
 * @copyright: Copyright (c) 2016 SailShop System
 * @date: 2016-01-25
 */

use yii\bootstrap\Tabs;
use yii\helpers\Url;

?>
<?= Tabs::widget([
    'itemOptions' => ['class' => 'form-group'],
    'items' => [
        [
            'label' => '数据库概况',
            'url' => Url::toRoute('index'),
            'active' => Yii::$app->controller->action->id == 'index',
        ],
        [
            'label' => '执行SQL语句',
            'url' => Url::toRoute('sql'),
            'active' => Yii::$app->controller->action->id == 'sql',
        ],
        [
            'label' => '数据库还原',
            'url' => Url::toRoute('restore'),
            'active' => Yii::$app->controller->action->id == 'restore',
        ],
    ],
]);
?>


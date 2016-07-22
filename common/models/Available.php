<?php
/**
 * @name: SailShop System
 * @author: 游梦惊园
 * @link: https://github.com/duanbiaowu/sailshop
 * @blog: http://www.cnblogs.com/duanbiaowu
 * @copyright: Copyright (c) 2016 SailShop System
 * @date: 2016-01-31
 */

namespace common\models;

use Yii;

class Available
{
    const AVAILABLE = 1;
    const DISABLE = 0;

    public static function labels()
    {
        return [
            self::AVAILABLE => Yii::t('System', 'common_available'),
            self::DISABLE => Yii::t('System', 'common_disable'),
        ];
    }

    public static function getLabel($status)
    {
        $labels = self::labels();
        return $labels[$status] ? $labels[$status] : null;
    }

    public static function getStyle($status)
    {
        $styles = [
            self::AVAILABLE => 'label label-success',
            self::DISABLE => 'label label-danger',
        ];
        return $styles[intval($status)];
    }

}
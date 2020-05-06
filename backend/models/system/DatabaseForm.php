<?php
/**
 * @name: SailShop System
 * @author: 游梦惊园
 * @link: https://github.com/duanbiaowu/sailshop
 * @blog: http://www.cnblogs.com/duanbiaowu
 * @copyright: Copyright (c) 2016 SailShop System
 * @date: 2015-12-16
 */

namespace backend\models\system;

use Yii;
use yii\base\Model;

class DatabaseForm extends Model
{
    public $sql;

    public function scenarios()
    {
        return [
            'sql' => ['sql'],
        ];
    }

    public function rules()
    {
        return [
            [['sql'], 'required', 'on' => 'sql'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'sql' => 'SQL',
        ];
    }
}
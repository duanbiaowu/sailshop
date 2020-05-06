<?php
/**
 * @name: SailShop System
 * @author: 游梦惊园
 * @link: https://github.com/duanbiaowu/sailshop
 * @blog: http://www.cnblogs.com/duanbiaowu
 * @copyright: Copyright (c) 2016 SailShop System
 * @date: 2015-12-05
 */

namespace backend\models\system;

use Yii;
use yii\base\Model;

class OtherForm extends Model
{
    public $currencySymbol;
    public $currencyUnit;
    public $invoice;
    public $orderDelay;

    public function rules()
    {
        return [
            ['orderDelay', 'default', 'value' => 3600],
            [['currencySymbol', 'currencyUnit',], 'required'],
            ['invoice', 'boolean', 'trueValue' => true, 'falseValue' => false, 'strict' => false],
        ];
    }

    public function attributeLabels()
    {
        return [
            'currencySymbol' => Yii::t('System', 'form_other_currency_symbol'),
            'currencyUnit' => Yii::t('System', 'form_other_currency_unit'),
            'invoice' => Yii::t('System', 'form_other_invoice'),
            'orderDelay' => Yii::t('System', 'form_other_order_delay'),
        ];
    }

    public function saveConfig()
    {
        $otherBaseInfo = array_merge(
            require(__DIR__ . '/../../../common/config/params.php'),
            ['otherBaseInfo' => $this->attributes]
        );

        $otherBaseInfo = "<?php \n return " . var_export($otherBaseInfo, true) . ';';

        return file_put_contents(Yii::getAlias('@common/config/params.php'), $otherBaseInfo);
    }
}
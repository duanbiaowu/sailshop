<?php
/**
 * @name: SailShop System
 * @author: 游梦惊园
 * @link: https://github.com/duanbiaowu/sailshop
 * @blog: http://www.cnblogs.com/duanbiaowu
 * @copyright: Copyright (c) 2016 SailShop System
 * @date: 2015-11-12
 */

namespace backend\models\system;

use Yii;
use yii\base\Model;

class SiteForm extends Model
{
    public $siteName;
    public $keyword;
    public $description;
    public $siteIcp;
    public $siteUrl;
    public $email;
    public $mobile;
    public $zip;
    public $address;
    public $updated_at;

    public function rules()
    {
        return [
            [['siteName', 'keyword', 'siteIcp'], 'required'],
            [['description', 'siteUrl', 'email', 'mobile', 'zip', 'address'], 'safe'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'siteName' => Yii::t('System', 'form_site_name'),
            'keyword' => Yii::t('System', 'form_site_keyword'),
            'siteIcp' => Yii::t('System', 'form_site_icp'),
            'description' => Yii::t('System', 'form_site_description'),
            'siteUrl' => Yii::t('System', 'form_site_url'),
            'email' => Yii::t('System', 'form_site_email'),
            'mobile' => Yii::t('System', 'form_site_mobile'),
            'zip' => Yii::t('System', 'form_site_zip'),
            'address' => Yii::t('System', 'form_site_address'),
        ];
    }

    public function saveConfig()
    {
        $siteBaseInfo = array_merge(
            require(__DIR__ . '/../../../common/config/params.php'),
            ['siteBaseInfo' => $this->attributes]
        );

        $siteBaseInfo = "<?php \n return " . var_export($siteBaseInfo, true) . ';';

        return file_put_contents(Yii::getAlias('@common/config/params.php'), $siteBaseInfo);
    }
}
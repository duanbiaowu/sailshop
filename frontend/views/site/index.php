<?php
/**
 * @link: http://www.h2o-china.com
 * @Copyright (c) 2017 E20-Framework
 * @author Biaowu Duan <codean.net@gmail.com>
 * @version 1.0
 */

use common\models\goods\Brand;
use yii\helpers\Html;

$brands = Brand::find()->orderBy(['sort' => SORT_DESC])->asArray()->all();

?>

<div class="banner swiper" style="height: 396px;" config-data="{'direction': 'left'}">
    <ul class="cycle-slideshow">
        <li style="background-image:url(http://tinyshop.e20.net/data/uploads/2014/05/13/b5cf5e20eda87a3ff77e4a2d33828947.jpg) ">
            <a href="/" target="_blank"></a>
        </li>
        <li style="background-image:url(http://tinyshop.e20.net/data/uploads/2014/05/13/9670df531a008c75e7bed5b8967efd66.gif) ">
            <a href="/" target="_blank"></a>
        </li>
    </ul>
</div>
<div class="container">
    <div class="sub-1">
        <div class="list">
            <ul class="row-5 category-index">
                <li class="col title">
                    <fieldset class="line-title">
                        <legend align="center">新书排行</legend>
                    </fieldset>
                </li>

                <li class="col title">
                    <ul class="row">
                        <?php for ($i = 0; $i < 10; ++$i): ?>
                        <li class="col-1">
                            <div class="item">
                                <div class="header">
                                    <a href="/index.php?con=index&act=product&id=16"><img src="http://tinyshop.e20.net/data/uploads/2014/04/30/62527b26f1afbe204f247b72d1f20c2d.jpg__220_220.jpg" width=$w></a>
                                </div>
                                <ul class="main">
                                    <li class="title"><a href="/index.php?con=index&act=product&id=16">BRIOSO格子衬衫 女 长袖2014春装新款女装修身韩版大码百搭衬衣潮</a></li>
                                    <li class="price">49.00元</li>
                                </ul>
                            </div>
                        </li>
                        <?php endfor; ?>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>

<div class="promise">
    <div class="container">
        <?php foreach ($brands as $brand): ?>
            <dl style="width: 240px; height: 50px; margin: 2px; border: 1px solid #dedede;">
                <dd>
                    <p>
                        <a href="<?= $brand['url'] ?>" target="_blank">
                            <?= Html::img($brand['logo']) ?>
                        </a>
                    </p>
                </dd>
            </dl>
        <?php endforeach; ?>
    </div>
</div>
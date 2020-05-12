<?php
/**
 * @link: http://www.h2o-china.com
 * @Copyright (c) 2017 E20-Framework
 * @author Biaowu Duan <codean.net@gmail.com>
 * @version 1.0
 */

use common\models\goods\Book;
use common\models\goods\Brand;
use yii\helpers\Html;

/* @var Book[] $newBooks */
/* @var array $bookOrders */
/* @var Book[] $bestSellingBooks */
/* @var array $bookBrowses */
/* @var Book[] $hotBooks */
/* @var Book[] $recommendBooks */
/* @var Brand[] $brands */

?>

<div class="banner swiper" style="height: 396px;" config-data="{'direction': 'left'}">
    <ul class="cycle-slideshow">
        <li style="background-image:url(/images/0759c1bb53abee7.jpg); background-repeat: no-repeat; background-size: 100% 100%;">
            <a href="/" target="_blank"></a>
        </li>
        <li style="background-image:url(/images/0759c1bb53abee8.jpeg); background-repeat: no-repeat; background-size: 100% 100%;">
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
                        <legend align="center">新书上架</legend>
                    </fieldset>
                </li>

                <li class="col title">
                    <ul class="row">
                        <?php foreach($newBooks as $book): ?>
                        <li class="col-1">
                            <div class="item">
                                <div class="header">
                                    <a href="/book/detail?isbn=<?= $book->isbn ?>" target="_blank">
                                        <img src="/<?= $book->thumbnail ?>" width="220">
                                    </a>
                                </div>
                                <ul class="main">
                                    <li class="title">
                                        <a href="/book/detail?isbn=<?= $book->isbn ?>" target="_blank">
                                            <?= $book->name ?>
                                        </a>
                                    </li>
                                    <li class="price"><?= $book->price ?>元</li>
                                </ul>
                            </div>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </li>
            </ul>
        </div>

        <div class="list">
            <ul class="row-5 category-index">
                <li class="col title">
                    <fieldset class="line-title">
                        <legend align="center">畅销排行</legend>
                    </fieldset>
                </li>

                <li class="col title">
                    <ul class="row">
                        <?php foreach($bookOrders as $isbn => $book): ?>
                            <li class="col-1">
                                <div class="item">
                                    <div class="header">
                                        <a href="/book/detail?isbn=<?= $bestSellingBooks[$isbn]->isbn ?>" target="_blank">
                                            <img src="/<?= $bestSellingBooks[$isbn]->thumbnail ?>" width="220">
                                        </a>
                                    </div>
                                    <ul class="main">
                                        <li class="title">
                                            <a href="/book/detail?isbn=<?= $bestSellingBooks[$isbn]->isbn ?>" target="_blank">
                                                <?= $bestSellingBooks[$isbn]->name ?>
                                            </a>
                                        </li>
                                        <li class="price"><?= $bestSellingBooks[$isbn]->price ?>元</li>
                                    </ul>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </li>
            </ul>
        </div>

        <div class="list">
            <ul class="row-5 category-index">
                <li class="col title">
                    <fieldset class="line-title">
                        <legend align="center">热门浏览</legend>
                    </fieldset>
                </li>

                <li class="col title">
                    <ul class="row">
                        <?php foreach($bookBrowses as $isbn => $book): ?>
                            <li class="col-1">
                                <div class="item">
                                    <div class="header">
                                        <a href="/book/detail?isbn=<?= $hotBooks[$isbn]->isbn ?>" target="_blank">
                                            <img src="/<?= $hotBooks[$isbn]->thumbnail ?>" width="220">
                                        </a>
                                    </div>
                                    <ul class="main">
                                        <li class="title">
                                            <a href="/book/detail?isbn=<?= $hotBooks[$isbn]->isbn ?>" target="_blank">
                                                <?= $hotBooks[$isbn]->name ?>
                                            </a>
                                        </li>
                                        <li class="price"><?= $hotBooks[$isbn]->price ?>元</li>
                                    </ul>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </li>
            </ul>
        </div>

        <div class="list">
            <ul class="row-5 category-index">
                <li class="col title">
                    <fieldset class="line-title">
                        <legend align="center">书店推荐</legend>
                    </fieldset>
                </li>

                <li class="col title">
                    <ul class="row">
                        <?php foreach($recommendBooks as $book): ?>
                            <li class="col-1">
                                <div class="item">
                                    <div class="header">
                                        <a href="/book/detail?isbn=<?= $book->isbn ?>" target="_blank">
                                            <img src="/<?= $book->thumbnail ?>" width="220">
                                        </a>
                                    </div>
                                    <ul class="main">
                                        <li class="title">
                                            <a href="/book/detail?isbn=<?= $book->isbn ?>" target="_blank">
                                                <?= $book->name ?>
                                            </a>
                                        </li>
                                        <li class="price"><?= $book->price ?>元</li>
                                    </ul>
                                </div>
                            </li>
                        <?php endforeach; ?>
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
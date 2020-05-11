<?php
/**
 * @link: http://www.h2o-china.com
 * @Copyright (c) 2017 E20-Framework
 * @author Biaowu Duan <codean.net@gmail.com>
 * @version 1.0
 */

/* @var Order $order */
/* @var Book[] $books */
/* @var OrderAppraise[] $appraises */
/* @var array $records */

/* @var Pagination $pagination */

use common\models\goods\Book;
use common\models\order\Order;
use common\models\order\OrderAppraise;
use frontend\widgets\LinkPager;
use yii\data\Pagination;
use yii\helpers\Html;

?>


<html lang="zh">
<head>
    <meta charset="UTF-8">
    <title></title>
    <link type="text/css" rel="stylesheet" href="/themes/default/css/common.css"/>
    <link type="text/css" rel="stylesheet" href="/themes/default/css/simple.css"/>
    <link rel="stylesheet" href="/themes/default/vendors/awesome/css/font-awesome.min.css">
    <script type="text/javascript" charset="UTF-8" src="/themes/default/systemjs/jquery.min.js"></script>
    <script type='text/javascript' src="/themes/default/js/common.min.js"></script>
</head>
<body>
<script type="text/javascript" charset="UTF-8"
        src="/themes/default/systemjs/artdialog/artDialog.js?skin=brief"></script>
<script type="text/javascript" charset="UTF-8" src="/themes/default/systemjs/artdialog/plugins/iframeTools.js"></script>
<style>
    .tiny-form .line .caption {
        width: 90px;
        line-height: 38px;
        height: 38px;
        background-color: #F8F8F8;
        text-align: left;
        text-overflow: ellipsis;
        overflow: hidden;
        display: inline-block;
        padding: 0 0 0 10px;
    }
</style>

<!--S 产品展示-->
<link rel="stylesheet" type="text/css" href="/themes/default/systemjs/form/style.css">
<script type="text/javascript" charset="UTF-8" src="/themes/default/systemjs/form/form.js"></script>
<link href="/themes/default/css/product.css" rel="stylesheet" type="text/css">
<script src="/themes/default/vendors/raphael-min.js" type="text/javascript"></script>
<script src="/themes/default/vendors/jquery.ratemate.js" type="text/javascript"></script>


<div style="padding:20px 30px;">
    <div class="container blank category-index">
        <div class="list">
            <div class="row-5">
                <div class="col-2" style="width: auto;">

                    <?php foreach ($books as $book): ?>
                        <div class="item">
                            <div class="header">
                                <img class="big-pic" src="/<?= $book->thumbnail ?>" width="320px">
                            </div>
                            <div class="main">
                                <div class="title">
                                    <a href="/book/detail?isbn=<?= $book->isbn ?>" target="_blank">
                                        <?= $book->name ?>
                                    </a>
                                </div>
                                <p class="price">
                                    销售价：
                                    <b class="red">￥<?= $book->price ?> </b>
                                </p>
                                <p class="tc">
                                    <a class="btn btn-main" href="/book/detail?isbn=<?= $book->isbn ?>" target="_blank">
                                        前去购买
                                    </a>
                                </p>
                            </div>
                        </div>
                    <?php endforeach; ?>

                </div>

                <div class="col-3">
                    <div class="spec-info mt10 clearfix">
                        <h2 class="title">

                        </h2>
                        <form action="" class="tiny-form hidden-msg" method="post" formmsg="field-info" novalidate="true">

                            <li class="line blank">
                                <div id="field-info" class="alert alert-fail" style="display:none;position:relative;"></div>
                            </li>

                            <?php foreach ($books as $index => $book): ?>
                                <h4 class="title">
                                    您已完成评价
                                </h4>

                                <div style="height: 320px;">
                                    <?php foreach ($appraises[$book->isbn] as $id => $appraise): ?>
                                    <div style="height: 160px;">
                                        <li class="line" style="margin-bottom: 0px;">
                                            <input id="js-rate-input-<?= $appraise->id ?>" max="5" min="0" step="1"
                                                   style="display:none" type="number" value="<?= $appraise->score ?>">
                                        </li>
                                        <li class="line textarea">
                                            <label class="caption" style="height: auto; line-height: 30px; width: 70%;">
                                                <?= $appraise->create_time ?> <br/>
                                                <?= $appraise->content ?>
                                            </label>
                                        </li>
                                    </div>
                                <?php endforeach; ?>
                                </div>

                            <?php endforeach; ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(function () {
        <?php foreach ($books as $index => $book): ?>
        <?php foreach ($appraises[$book->isbn] as $id => $appraise): ?>
        $('#js-rate-input-<?= $appraise->id ?>').ratemate({
            width: 250,
            height: 50
        });
        <?php endforeach; ?>
        <?php endforeach; ?>
    });
</script>

</body>
</html>
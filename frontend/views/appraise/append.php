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

<!--S 产品展示-->
<link rel="stylesheet" type="text/css" href="/themes/default/systemjs/form/style.css">
<script type="text/javascript" charset="UTF-8" src="/themes/default/systemjs/form/form.js"></script>
<link href="/themes/default/css/product.css" rel="stylesheet" type="text/css">
<script src="/themes/default/vendors/raphael-min.js" type="text/javascript"></script>
<script src="/themes/default/vendors/jquery.ratemate.js" type="text/javascript"></script>

<div class="container blank category-index">
    <div class="list">
        <div class="row-5">
            <div class="col-2">

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
                        <?= Html::hiddenInput(Yii::$app->request->csrfParam, Yii::$app->request->csrfToken) ?>

                        <li class="line blank" style="width:600px;">
                            <div id="field-info" class="alert alert-fail" style="display:none;position:relative;"></div>
                        </li>

                        <?php foreach ($books as $index => $book): ?>
                        <?php if (isset($appraises[$book->isbn][1])): ?>
                        <h4 class="title">
                            您已完成评价
                        </h4>

                        <?php foreach ($appraises[$book->isbn] as $id => $appraise): ?>
                        <div style="position: relative; height: 150px;">
                        <li class="line" style="margin-bottom: 0px;">
                            <input id="js-rate-input-<?= $id ?>" max="5" min="0" step="1" style="display:none" type="number" value="<?= $appraise->score ?>">
                        </li>
                        <li class="line textarea">
                            <label class="caption" style="height: auto; line-height: 30px;">
                                <?= $appraise->create_time ?> <br />
                                <?= $appraise->content ?>
                            </label>
                        </li>
                        </div>
                        <?php endforeach; ?>

                        <?php else: ?>

                        <h4 class="title">
                            追加评价
                        </h4>
                        <li class="line">
                            <input id="js-rate-input-<?= $index ?>" name="score[<?= $book->isbn ?>]" max="5" min="0" step="1" style="display:none" type="number" value="0">
                        </li>
                        <li class="line textarea">
                            <label class="caption" style="line-height: 30px;">
                                追加评价内容：
                            </label>
                            <textarea name="content[<?= $book->isbn ?>]" minlen="5" maxlength="200" pattern="required" alt="内容不能少于5个字" inform="1"></textarea>
                        </li>
                        <?php endif ?>
                        <?php endforeach; ?>

                        <?php if (count($records) != (count($books) * 2)): ?>
                        <input class="btn btn-main" type="submit" value="提交评价">
                        <?php endif; ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(function () {
        <?php foreach ($books as $index => $book): ?>
            <?php foreach ($appraises[$book->isbn] as $id => $appraise): ?>
            $('#js-rate-input-<?= $index ?>').ratemate({
                width: 250,
                height: 50
            });
            <?php endforeach; ?>
        <?php endforeach; ?>
    });
</script>
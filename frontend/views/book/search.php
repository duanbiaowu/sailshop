<?php
/**
 * @link: http://www.h2o-china.com
 * @Copyright (c) 2017 E20-Framework
 * @author Biaowu Duan <codean.net@gmail.com>
 * @version 1.0
 */

use common\models\goods\Book;
use common\models\goods\Category;
use frontend\widgets\LinkPager;
use yii\data\Pagination;

/* @var string $keyword */
/* @var Category $category */
/* @var Category[] $ancestors */
/* @var Book[] $books */
/* @var Pagination $pagination */
/* @var array $priceOptions */
/* @var integer $priceIndex */
/* @var string $sortName */
/* @var string $sortValue */

?>


<!--S 产品展示-->
<link type="text/css" rel="stylesheet" href="/themes/default/css/product.css">
<div class="bread-crumb">
    <ol class="container">
        <li>搜索结果:</li>
        <li><b><?= $keyword ?></b></li>
    </ol>
</div>

<div class="container">
    <!--S 筛选部分-->

    <form action="" method="get" id="js-book-selector-form">
        <input type="hidden" name="priceOption" value="<?= $priceIndex ?>" />
        <input type="hidden" name="sortName" value="<?= $sortName ?>" />
        <input type="hidden" name="sortValue" value="<?= $sortValue ?>" />
        <input type="hidden" name="keyword" value="<?= \Yii::$app->getRequest()->getQueryParam('keyword') ?>" />
    </form>

    <div id="selector">
        <div class="spec-attr box">
            <?php if ($keyword): ?>
            <h2><span class="red"><?= $keyword ?></span> 图书筛选</h2>
            <?php else: ?>
            <h2> 全部图书</h2>
            <?php endif; ?>
            <!--S 品牌-->
            <!--E 品牌-->
            <!--S 价格-->
            <dl class="attr clearfix">
                <dt class="attr-key">价格：</dt>
                <dd class="attr-value">
                    <?php foreach ($priceOptions as $index => $priceOption): ?>
                    <a href="javascript:;" class="js-book-price-range <?php if (is_numeric($priceIndex) && $priceIndex == $index): ?>btn btn-danger btn-sm<?php endif; ?>" style="height: 20px; padding: 2px 15px 2px 15px;">
                        <?= $priceOption[0] ?><?= isset($priceOption[1]) ? ('-' . $priceOption[1]) : '以上' ?>
                    </a>
                    <?php endforeach; ?>
                </dd>
            </dl>
            <!--E 价格-->
        </div>
        <div id="select-more">
            <div class="attr-extra">
                <div></div>
            </div>
        </div>
    </div>
    <!--E 筛选部分-->
    <!-- S 排序部分 -->
    <div class="sort-bar clearfix">
        <span>排序：</span>
        <a href="javascript:;" data-sort="default" class="js-sort-attribute <?php if ($sortName == 'default'): ?>current<?php endif; ?>">默认<i class="ie6png"></i></a>
        <a href="javascript:;" data-sort="sales" class="js-sort-attribute <?php if ($sortName == 'sales'): ?>current<?php endif; ?>">销量<i></i></a>
        <a href="javascript:;" data-sort="comment" class="js-sort-attribute <?php if ($sortName == 'comment'): ?>current<?php endif; ?>">评论数<i class="ie6png"></i></a>
        <a href="javascript:;" data-sort="price" class="js-sort-attribute <?php if ($sortName == 'price'): ?><?php if ($sortValue):?>current<?php else: ?>current-2<?php endif; ?><?php endif; ?>">
            价格<i class="ie6png"></i>
        </a>
        <a href="javascript:;" data-sort="time" class="js-sort-attribute <?php if ($sortName == 'time'): ?>current<?php endif; ?>">最新<i class="ie6png"></i></a>
    </div>

    <div class="list">
        <ul class="row-4">
            <?php foreach ($books as $book): ?>
            <li class="col-1">
                <div class="item">
                    <div class="header">
                        <a href="/book/detail?isbn=<?= $book->isbn ?>" target="_blank">
                            <img src="/<?= $book->thumbnail ?>" width="240">
                        </a>
                    </div>
                    <ul class="main">
                        <li class="title">
                            <a href="/book/detail?isbn=<?= $book->isbn ?>" target="_blank">
                                <?= $book->name ?>
                            </a>
                        </li>
                        <li><span class="price">￥<?= $book->price ?></span></li>
                    </ul>
                    <div class="footer">
                        <a href="/book/detail?isbn=<?= $book->isbn ?>" class="btn btn-default" target="_blank">图书详情</a>
                    </div>
                </div>
            </li>
            <?php endforeach; ?>
        </ul>
    </div>

    <?php echo LinkPager::widget([
        'pagination' => $pagination,
        'nextPageLabel' => '下一页',
        'prevPageLabel' => '上一页',
        'options' => ['class' => 'page-nav'],
    ]); ?>
    <!-- E 排序部分 -->
</div>
<!-- S 脚本处理 -->
<script>

    $('.js-book-price-range').on('click', function() {
        $('input[name="priceOption"]').val($(this).index());
        $('#js-book-selector-form').submit();
    });

    $('.js-sort-attribute').on('click', function () {
        var name = $(this).data('sort');
        var input = $('input[name="sortName"]');
        var valueInput = $('input[name="sortValue"]');
        if (name === input.val()) {
            valueInput.val(1 - parseInt(valueInput.val()));
        } else {
            valueInput.val(1);
        }
        input.val(name);
        $('#js-book-selector-form').submit();
    });

    var attr_extra = '';
    $(".attr").each(function (i) {
        var self = $(this);
        if (i > 3) {
            //self.css("display","none");
            // attr_extra += self.find(".attr-key:eq(0)").text()+"、";
        }
        if (self.find(".attr-value").get(0).scrollHeight > self.height()) {
            var span = $("<div class='o-more'>更多<b></b></div>");
            self.append(span);
            if (self.find('.select').size() > 0) {
                span.html('收起<b></b>');
                span.parent().addClass("unflod");
            }
            span.on("click", function () {
                if ($(this).text() == '更多') {
                    $(this).html('收起<b></b>');
                    $(this).parent().addClass("unflod");
                } else {
                    $(this).html('更多<b></b>');
                    $(this).parent().removeClass("unflod");
                }
            });
        }
    });

    attr_extra = $(".attr:gt(3) .attr-key").text();
    attr_extra = $.trim(attr_extra);
    attr_extra = attr_extra.replace(/：/gi, '、');
    attr_extra = attr_extra.replace(/、$/gi, '');
    if ($(".attr:gt(3)").size() > 0) {

        if ($(".attr:gt(3)").find(".select").size() > 0) {
            $(".attr:gt(3)").css("display", "block");
            $(".attr-extra div:eq(0)").html('收起<b></b>');
            $(".attr-extra").addClass("unflod");
        } else {
            $(".attr:gt(3)").css("display", "none");
            $(".attr-extra div:eq(0)").html('更多选项（' + attr_extra + '）<b></b>');
            $(".attr-extra").removeClass("unflod");
        }
    } else {
        $("#select-more").css("display", "none");
    }
    $(".attr-extra:eq(0)").on("click", function () {
        if ($(".attr:hidden").size() > 0) {
            $(".attr:gt(3)").css("display", "block");
            $(".attr-extra div:eq(0)").html('收起<b></b>');
            $(".attr-extra").addClass("unflod");
        } else {
            $(".attr:gt(3)").css("display", "none");
            $(".attr-extra div:eq(0)").html('更多选项（' + attr_extra + '）<b></b>');
            $(".attr-extra").removeClass("unflod");
        }

    })

    $(".attention").on("click", function () {
        var id = $(this).attr("val");
        $.post("/index.php?con=index&act=attention", {
            goods_id: id
        }, function (data) {
            if (data['status'] == 2) layer.msg("<p class='warning'>已关注过了该图书！</p>");
            else if (data['status'] == 1) layer.msg("<p class='success'>成功关注了该图书!</p>");
            else {
                loginMin();
            }
        }, 'json')
    })
</script>
<!-- E 脚本处理 -->



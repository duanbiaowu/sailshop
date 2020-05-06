<?php
/**
 * @link: http://www.h2o-china.com
 * @Copyright (c) 2017 E20-Framework
 * @author Biaowu Duan <codean.net@gmail.com>
 * @version 1.0
 */

/* @var MemberBrowseRecord[] $records */
/* @var Pagination $pagination */

use common\models\MemberBrowseRecord;
use frontend\widgets\LinkPager;
use yii\data\Pagination;

?>

<link type="text/css" rel="stylesheet" href="/themes/default/css/ucenter.css">

<div class="container list blank">
    <div class="row-5">

        <?= $this->render('/member/_menu') ?>

        <div class="col-4">
            <h1 class="title"><span>我的关注：</span></h1>
            <form action="" method="post">
                <table class="table table-list" style="text-align: left;">
                    <tbody>
                    <tr>
                        <th width="100"></th>
                        <th>图书</th>
                        <th width="100">价格</th>
                        <th width="60">库存</th>
                    </tr>

                    <?php foreach ($records as $record): ?>
                    <tr class="even">
                        <td>
                            <a href="/book/detail?isbn=<?= $record->isbn ?>" target="_blank">
                                <img src="/<?= $record->getIsbn()->one()->thumbnail ?>" width="60" height="60">
                            </a>
                        </td>
                        <td>
                            <a href="/book/detail?isbn=<?= $record->isbn ?>" target="_blank">
                                <?= $record->getIsbn()->one()->name ?>
                            </a>
                        </td>
                        <td class="red" style="font-size:14px;"><b>￥<?= $record->getIsbn()->one()->price ?></b></td>
                        <td><?= $record->getIsbn()->one()->stock ?></td>
                    </tr>
                    <?php endforeach; ?>
                    <tr>
                        <td colspan="4">
                            <?php echo LinkPager::widget([
                                'pagination' => $pagination,
                                'nextPageLabel' => '下一页',
                                'prevPageLabel' => '上一页',
                                'options' => ['class' => 'page-nav'],
                            ]); ?>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </form>
        </div>
    </div>
</div>

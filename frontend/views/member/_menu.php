<?php
/**
 * @link: http://www.h2o-china.com
 * @Copyright (c) 2017 E20-Framework
 * @author Biaowu Duan <codean.net@gmail.com>
 * @version 1.0
 */

?>

<div class="col-1">
    <div id="widget_sub_navs"><div class="side-menu">
            <h2 class="header">用户中心</h2>
            <div class="sub-menu">
                <h2 class="header">交易管理</h2>
                <ul class="">

                    <li class="menu-item <?php if (strpos(\Yii::$app->getRequest()->url, '/order') !== false): ?>current<?php endif ?>">
                        <a href="/order/index">我的订单<span class="l-triangle"></span></a>
                    </li>

                    <li class="menu-item <?php if (\Yii::$app->getRequest()->url === '/member/browse/index'): ?>current<?php endif ?>">
                        <a href="/member/browse/index">浏览记录<span class="l-triangle"></span></a>
                    </li>

                    <li class="menu-item <?php if (strpos(\Yii::$app->getRequest()->url, '/appraise') !== false): ?>current<?php endif ?>">
                        <a href="/appraise/index">图书评价<span class="l-triangle"></span></a>
                    </li>
                </ul>
                <h2 class="header">账户管理</h2>
                <ul class="">

                    <li class="menu-item <?php if (strpos(\Yii::$app->getRequest()->url, '/member/password') !== false): ?>current<?php endif ?>">
                        <a href="/member/password/index">账户安全<span class="l-triangle"></span></a>
                    </li>
                    <li class="menu-item <?php if (\Yii::$app->getRequest()->url === '/member/address/index'): ?>current<?php endif ?>">
                        <a href="/member/address/index">收货地址<span class="l-triangle"></span></a>
                    </li>
                    <li class="menu-item <?php if (\Yii::$app->getRequest()->url === '/member/account/index'): ?>current<?php endif ?>">
                        <a href="/member/account/index">账户金额<span class="l-triangle"></span></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

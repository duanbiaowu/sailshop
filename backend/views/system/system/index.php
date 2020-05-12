<?php
/**
 * @name: SailShop System
 * @author: 游梦惊园
 * @link: https://github.com/duanbiaowu/sailshop
 * @blog: http://www.cnblogs.com/duanbiaowu
 * @copyright: Copyright (c) 2016 SailShop System
 * @date: 2015-10-26
 */

$this->title = '系统信息';
$this->params['breadcrumbs'][] = $this->title;

use common\models\goods\Book;
use common\models\Member;
use common\models\order\Order; ?>

<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-user-plus fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?= Member::find()->count() ?></div>
                        <div>用户总数</div>
                    </div>
                </div>
            </div>
            <a href="/member/member/index">
                <div class="panel-footer">
                    <span class="pull-left">查看详情</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-tasks fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?= Book::find()->count() ?></div>
                        <div>图书总数</div>
                    </div>
                </div>
            </div>
            <a href="/goods/book">
                <div class="panel-footer">
                    <span class="pull-left">查看详情</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-shopping-cart fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?= Order::find()->count() ?></div>
                        <div>订单总数</div>
                    </div>
                </div>
            </div>
            <a href="/order/order">
                <div class="panel-footer">
                    <span class="pull-left">查看详情</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-support fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?= Order::find()->andWhere(['<>', 'status', Order::PAY_STATUS])->count() ?></div>
                        <div>待发货订单</div>
                    </div>
                </div>
            </div>
            <a href="/order/order/index?OrderSearch[status]=<?= Order::PAY_STATUS ?>">
                <div class="panel-footer">
                    <span class="pull-left">查看详情</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
</div>

<div class="page-header">
    <h4>系统信息</h4>
</div>
<div class="row">
    <div class="col-sm-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                系统名称
            </div>
            <div class="panel-body">
                扬帆书店管理后台系统
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="panel panel-success">
            <div class="panel-heading">
                服务器操作系统
            </div>
            <div class="panel-body">
                <?= PHP_OS ?>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="panel panel-info">
            <div class="panel-heading">
                PHP版本
            </div>
            <div class="panel-body">
                <?= PHP_VERSION ?>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                作者
            </div>
            <div class="panel-body">
                <a href="https://github.com/duanbiaowu" target="_blank">段彪武</a>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="panel panel-success">
            <div class="panel-heading">
                Web服务器
            </div>
            <div class="panel-body">
                <?= $_SERVER['SERVER_SOFTWARE'] ?>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="panel panel-info">
            <div class="panel-heading">
                MySQL版本
            </div>
            <div class="panel-body">
                <?= $mysqlVersion[0] ?>
            </div>
        </div>
    </div>
</div>

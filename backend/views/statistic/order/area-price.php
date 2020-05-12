<?php
/**
 * @link: http://www.h2o-china.com
 * @Copyright (c) 2017 E20-Framework
 * @author Biaowu Duan <codean.net@gmail.com>
 * @version 1.0
 */

use yii\helpers\Html;
use yii\web\View;

/* @var View $this */
/* @var string $countData */
/* @var string $priceData */
/* @var string $start */
/* @var string $end */


$this->title = '订单金额分布统计';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="form-group">
    <form action="" method="get">
        <div class="form-group col-sm-5">
            <label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
            <div class="input-group">
                <div class="input-group-addon">日期：</div>
                <input name="create_time" type="text" value="<?= $start ?> -- <?= $end ?>" id="datepick" class="form-control" readonly="readonly">
                <div class="input-group-addon">
                    <a href="javascript:tools_submit();" id="condition" class="icon-search" style=""> 查询</a>
                </div>
            </div>
        </div>
        <div class="form-group col-sm-7">
    </form>
</div>

<div id="js-order-distribution-price" class="china-map"></div>
<div class="form-group">
    <h3 class="text-center">订单金额分布图</h3>
</div>

<?php $this->registerCss(<<<EOF
 .china-map {margin-left:50px;  width:700px; height: 800px; max-width:700px; background-color:#FFF; }
EOF
) ?>

<?php $this->registerJs(<<<EOF
 
 $("#js-order-distribution-price").Map({
    width:700,
    height:600,
    opacity:true,
    datas: $priceData ,
    tipContent:'{area} - 订单金额：{value}'
 });
EOF
) ?>

<?php $this->registerJsFile('@web/js/common.js', [
    'depends' => backend\assets\AppAsset::className()
]) ?>
<?php $this->registerJsFile('@web/js/highcharts.js', [
    'depends' => backend\assets\AppAsset::className()
]) ?>
<?php $this->registerJsFile('@web/js/highcharts-more.js', [
    'depends' => backend\assets\AppAsset::className()
]) ?>


<?php $this->registerJsFile('@web/js/raphael-min.js', [
    'depends' => backend\assets\AppAsset::className()
]) ?>
<?php $this->registerJsFile('@web/js/chinaMap.js', [
    'depends' => backend\assets\AppAsset::className()
]) ?>

<?php $this->registerJsFile('@web/js/daterangepicker/moment.min.js', [
    'depends' => backend\assets\AppAsset::className()
]) ?>
<?php $this->registerJsFile('@web/js/daterangepicker/daterangepicker.js', [
    'depends' => backend\assets\AppAsset::className()
]) ?>

<?php $this->registerCssFile('@web/js/daterangepicker/daterangepicker.css', [
    'depends' => backend\assets\AppAsset::className()
]) ?>

<?php $this->registerJs(<<<EOF
$(document).ready(function() {
      
    $('#datepick').daterangepicker(
     {
        minDate: '2012-01-01',
        maxDate: moment(),
//        dateLimit: { days: 60 },
        showDropdowns: true,
        showWeekNumbers: true,
        timePicker: false,
        timePickerIncrement: 1,
        timePicker12Hour: true,
        ranges: {
           '今天': [moment(), moment()],
           '昨天': [moment().subtract('days', 1), moment().subtract('days', 1)],
           '最近7天': [moment().subtract('days', 6), moment()],
           '最近30天': [moment().subtract('days', 29), moment()],
           '上一个月': [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf('month')]
        },
        opens: 'right',
        buttonClasses: ['btn btn-default'],
        applyClass: 'btn-small btn-primary',
        cancelClass: 'btn-small',
//        format: 'YYYY-MM-DD',
//        separator: ' -- ',
        locale: {
            format: 'YYYY-MM-DD',
            separator: ' -- ',
            weekLabel:'周',
            applyLabel: '提交',
            cancelLabel:'取消',
            fromLabel: '起始',
            toLabel: '结束',
            customRangeLabel: '选择时间段',
            daysOfWeek: ['日', '一', '二', '三', '四', '五','六'],
            monthNames: ['一月', '二月', '三月', '四月', '五月', '六月', '七月', '八月', '九月', '十月', '十一月', '十二月'],
            firstDay: 1
        }
     },
     function(start, end) {
        $('#datepick').val( start.format('YYYY-MM-DD'), end.format('YYYY-MM-DD') );
        return ;
//      $('#reportrange span').html(start.format('YYYY-MM-DD') + ' - ' + end.format('YYYY-MM-DD'));
//           FireEvent(document.getElementById('datepick'),'change');
     }
    );
    
    });
EOF
) ?>

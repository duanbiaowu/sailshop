<?php
/**
 * @link: http://www.h2o-china.com
 * @Copyright (c) 2017 E20-Framework
 * @author Biaowu Duan <codean.net@gmail.com>
 * @version 1.0
 */

namespace backend\controllers\statistic;


use common\models\goods\Book;
use common\models\order\Order;
use common\models\order\OrderDetail;
use yii\web\Controller;

class OrderController extends Controller
{
    public function actionAreaCount()
    {
        $timeRange = $this->getTimeRange();

        $result = Order::find()
            ->select(['province_id', 'province_name', 'COUNT(id) AS count'])
            ->where(['BETWEEN', 'create_time', $timeRange[0], $timeRange[1]])
            ->groupBy('province_id')
            ->asArray()
            ->indexBy('province_id')
            ->all();

        $countData = [];
        foreach ($result as $value) {
            $index = preg_replace('/(\s|省|市)/', '', $value['province_name']);
            $countData[$index] = $value['count'];
        }

        return $this->render('area-count', [
            'countData' => json_encode($countData),
            'start' => $timeRange[0],
            'end' => date('Y-m-d', strtotime($timeRange[1])),
        ]);
    }

    public function actionAreaPrice()
    {
        $timeRange = $this->getTimeRange();

        $result = Order::find()
            ->select(['province_id', 'province_name', 'COUNT(id) AS count', 'SUM(price_count) AS price'])
            ->where(['BETWEEN', 'create_time', $timeRange[0], $timeRange[1]])
            ->groupBy('province_id')
            ->asArray()
            ->indexBy('province_id')
            ->all();

        $countData = $priceData = [];
        foreach ($result as $value) {
            $index = preg_replace('/(\s|省|市)/', '', $value['province_name']);
            $countData[$index] = $value['count'];
            $priceData[$index] = $value['price'];
        }

        return $this->render('area-price', [
            'countData' => json_encode($countData),
            'priceData' => json_encode($priceData),
            'start' => $timeRange[0],
            'end' => date('Y-m-d', strtotime($timeRange[1])),
        ]);
    }

    public function actionSales()
    {
        $timeRange = $this->getTimeRange();
        $timeFragments = $this->getTimeFragments($timeRange[0], $timeRange[1]);

        $timeXAxis = [
            date('Y-m-d H:i', strtotime($timeFragments[0][0])),
        ];
        $orderPriceYAxis = [0];
        $bookPriceYAxis = [0];
        foreach ($timeFragments as $timeFragment) {
            $timeXAxis[] = date('Y-m-d H:i', strtotime($timeFragment[1]));
            $orderPriceYAxis[] = (double)Order::find()
                ->where(['BETWEEN', 'create_time', $timeFragment[0], $timeFragment[1]])
                ->sum('price_count');
            $bookPriceYAxis[] = (double)OrderDetail::find()
                ->where(['BETWEEN', 'create_time', $timeFragment[0], $timeFragment[1]])
                ->sum('price * number');
        }

        return $this->render('price', [
            'start' => $timeRange[0],
            'end' => date('Y-m-d', strtotime($timeRange[1])),
            'timeFragments' => $timeFragments,
            'timeXAxis' => $timeXAxis,
            'orderPriceYAxis' => $orderPriceYAxis,
            'bookPriceYAxis' => $bookPriceYAxis,
        ]);
    }

    public function actionHotBook()
    {
        $timeRange = $this->getTimeRange();

        $bookOrders = OrderDetail::find()
            ->select(['isbn', 'SUM(number) AS count'])
            ->where(['BETWEEN', 'create_time', $timeRange[0], $timeRange[1]])
            ->groupBy('isbn')
            ->orderBy(['count' => SORT_DESC])
            ->indexBy('isbn')
            ->limit(10)
            ->asArray()
            ->all();

        $bestSellingBooks = Book::getEnableBookQuery()
            ->andWhere(['isbn' => array_keys($bookOrders)])
            ->indexBy('isbn')
            ->all();

        $timeXAxis = $sellingCount = [];
        foreach ($bookOrders as $bookOrder) {
            $timeXAxis[] = $bestSellingBooks[ $bookOrder['isbn'] ]->name;
            $sellingCount[] = (double)$bookOrder['count'];
        }

        return $this->render('hot-book', [
            'start' => $timeRange[0],
            'end' => date('Y-m-d', strtotime($timeRange[1])),
            'timeXAxis' => $timeXAxis,
            'sellingCount' => $sellingCount,
        ]);
    }

    private function getTimeRange()
    {
        if ($createTime = \Yii::$app->getRequest()->getQueryParam('create_time')) {
            $values = explode('--', $createTime);
        } else {
            $values = [];
        }
        return [
            isset($values[0]) ? date('Y-m-d', strtotime(trim($values[0]))) : date('Y-m-d', time() - 86400 * 7),
            isset($values[1]) ? date('Y-m-d 23:59:59', strtotime(trim($values[1]))) : date('Y-m-d 23:59:59'),
        ];
    }

    private function getTimeFragments($start, $end)
    {
        $startTimestamp = strtotime($start);
        $endTimestamp = strtotime($end);
        $unit = ($endTimestamp - $startTimestamp) / 10;
        $fragments = [];

        $first = $startTimestamp;
        for ($i = 0; $i < 10; ++$i) {
            $second = $first + $unit;
            $fragments[] = [$first, $second - 1];
            $first = $second;
        }

        return array_map(function ($value) {
            return [
                date('Y-m-d H:i:s', $value[0]),
                date('Y-m-d H:i:s', $value[1]),
            ];
        }, $fragments);
    }
}
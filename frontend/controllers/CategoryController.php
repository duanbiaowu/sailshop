<?php
/**
 * @link: http://www.h2o-china.com
 * @Copyright (c) 2017 E20-Framework
 * @author Biaowu Duan <codean.net@gmail.com>
 * @version 1.0
 */

namespace frontend\controllers;


use common\models\goods\Book;
use common\models\goods\BookSearch;
use common\models\goods\Category;
use common\models\order\OrderAppraise;
use common\models\order\OrderDetail;
use yii\data\Pagination;
use yii\db\ActiveQuery;
use yii\helpers\ArrayHelper;
use yii\web\Controller;

class CategoryController extends Controller
{
    public function actionIndex($id)
    {
        $category = Category::findOne($id);
        if ($category === null) {
            return $this->redirect('/site/index');
        }

        $categories = Category::find()
            ->select('id')
            ->where(['like', 'path', Category::DELIMITER . $category->id . Category::DELIMITER])
            ->indexBy('id')
            ->all();

        $categoryIds = array_merge([$category->id], array_keys($categories));
        $query = Book::getEnableBookQuery()
            ->andWhere(['category_id' => $categoryIds]);

        $bookSearch = new BookSearch();
        $priceOptions = $bookSearch->priceOptions();
        $priceIndex = \Yii::$app->getRequest()->getQueryParam('priceOption');
        $bookSearch->addPriceParam($query, $priceOptions, $priceIndex);

        $sortName = \Yii::$app->getRequest()->getQueryParam('sortName');
        $sortValue = \Yii::$app->getRequest()->getQueryParam('sortValue');
        $bookSearch->addSortParam($query, $sortName, $sortValue);

        $pagination = new Pagination([
            'totalCount' => $query->count(),
        ]);

        $books = $query
            ->offset($pagination->getOffset())
            ->limit($pagination->getLimit())
            ->all();

        return $this->render('index', [
            'category' => $category,
            'ancestors' => $category->getAncestors(),
            'books' =>$books,
            'pagination' => $pagination,
            'priceOptions' => $priceOptions,
            'priceIndex' => $priceIndex,
            'sortName' => $sortName,
            'sortValue' => $sortValue,
        ]);
    }



    /**
     * @param ActiveQuery $query
     * @param string $name
     * @param string $value
     */
    private function preTreatSortQuery($query, $name, $value)
    {
        switch ($name) {
            case 'price' :
                $query->addOrderBy(['price' => $value ? SORT_DESC : SORT_ASC]);
                break;
            case 'time' :
                $query->addOrderBy(['create_time' => SORT_DESC]);
                break;
            case 'comment':
//                $query->leftJoin(OrderAppraise::tableName(),
//                        Book::tableName() . '.isbn = ' . OrderAppraise::tableName() . '.isbn')
//                    ->select([Book::tableName() . '.*',
//                        'COUNT(' . OrderAppraise::tableName() . '.isbn' . ') AS comment'])
//                    ->addGroupBy('isbn')
//                    ->addOrderBy(['comment' => SORT_DESC]);
                break;
            case 'sales':
                $query->leftJoin(OrderDetail::tableName(),
                        Book::tableName() . '.isbn = ' . OrderDetail::tableName() . '.isbn')
                    ->select([Book::tableName() . '.*', 'SUM(number) AS sales'])
                    ->addGroupBy(Book::tableName() . '.isbn')
                    ->addOrderBy(['sales' => SORT_DESC]);
                break;
            default:
        }
    }
}
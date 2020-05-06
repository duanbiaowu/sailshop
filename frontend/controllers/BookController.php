<?php
/**
 * @link: http://www.h2o-china.com
 * @Copyright (c) 2017 E20-Framework
 * @author Biaowu Duan <codean.net@gmail.com>
 * @version 1.0
 */

namespace frontend\controllers;


use common\models\goods\Book;
use common\models\goods\BookAuthor;
use common\models\goods\Brand;
use common\models\goods\Category;
use common\models\MemberBrowseRecord;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class BookController extends Controller
{
    public function actionDetail($isbn)
    {
        if (!$model = Book::findOne(['isbn' => $isbn, 'status' => Book::ENABLE_STATUS])) {
            throw new NotFoundHttpException('图书不存在或已经下架');
        }

        $browseRecord = MemberBrowseRecord::findOne([
            'member_id' => \Yii::$app->user->getId(),
            'isbn' => $model->isbn,
        ]);

        if ($browseRecord) {
            $browseRecord->increaseViews();
        } else {
            $browseRecord = new MemberBrowseRecord();
            $browseRecord->member_id = \Yii::$app->user->getId();
            $browseRecord->isbn = $model->isbn;
            $browseRecord->save();
        }

        if ($category = Category::findOne($model->category_id)) {
            $cateAncestors = $category->getAncestors();
            $cateAncestors[] = $category;
        } else {
            $cateAncestors = [];
        }

        $sameCategoryBooks = Book::find()
            ->where(['<>', 'isbn', $model->isbn])
            ->andWhere(['category_id' => $model->category_id])
            ->limit(3)
            ->all();

        return $this->render('detail', [
            'model' => $model,
            'cateAncestors' => $cateAncestors,
            'sameCategoryBooks' => $sameCategoryBooks,
            'brand' => Brand::findOne($model->brand_id),
            'bookAuthors' => BookAuthor::findAll(['isbn' => $model->isbn]),
        ]);
    }
}
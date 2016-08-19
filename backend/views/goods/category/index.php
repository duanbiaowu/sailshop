<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\goods\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $categories */

$this->title = Yii::t('Goods', 'Categories');
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="category-index">
    <p>
        <?= Html::a(Yii::t('Goods', 'Create Category'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <div class="list-group" v-cloak id="js-goods-category">
        <a v-for="option in options" href="javascript:;" class="list-group-item">
            <span v-for="n in option.depth">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
            <span v-if="option.length" class="glyphicon glyphicon-plus" aria-hidden="true"></span>
            {{option.name}} {{option.length}}
            <span class="badge progress-bar-danger">删除</span>
            <span class="badge progress-bar-info">编辑</span>
            <span class="badge progress-bar-success">查看</span>
        </a>
    </div>

</div>

<?php $this->registerJs(

    "

    var app = new Vue({
        el: '#js-goods-category',
        data: {
            categories: " . $categories . ",
            options: [],
            stack: []
        },
        methods: {
            init: function(categories, depth) {
                var length = this.options.length;
                for (var i in categories) {
                    this.options.push({
                        id: categories[i].id,
                        name: categories[i].name,
                        depth: depth,
                        length: 0
                    });

                    this.stack.push(this.options.length - 1);
                    this.options[this.stack.pop()].length = this.init(categories[i].children, depth + 1);
                }
                return this.options.length - length;
            }
        }
    });

    app.init(app.categories, 0);

"
); ?>
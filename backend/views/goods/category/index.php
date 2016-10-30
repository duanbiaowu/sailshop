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
        <a v-for="option in options" v-if="option.show" href="javascript:;" class="list-group-item">
            <span v-for="n in option.depth">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
            <span v-if="option.length" v-on:click="fold($index, option.length)" class="glyphicon glyphicon-{{option.css}}" aria-hidden="true"></span>
            {{option.name}}

            <div class="pull-right col-sm-2">
                <span class="glyphicon glyphicon-eye-open col-sm-4" v-on:click="operation('/goods/category/view?id=' + option.id)" aria-hidden="true"></span>
                <span class="glyphicon glyphicon-edit col-sm-4" v-on:click="operation('/goods/category/update?id=' + option.id)" aria-hidden="true"></span>
                <span class="glyphicon glyphicon-remove col-sm-2" v-on:click="operation('/goods/category/delete?id=' + option.id)" aria-hidden="true"></span>
            </div>
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
                        length: 0,
                        show: true,
                        css: 'minus'
                    });

                    this.stack.push(this.options.length - 1);
                    this.options[this.stack.pop()].length = this.init(categories[i].children, depth + 1);
                }
                return this.options.length - length;
            },

            fold: function(index, length) {
                var show = !this.options[++index].show;
                this.options[index - 1].css = show ? 'minus' : 'plus';
                for (var i = 0; i < length; i++, index++) {
                    this.options[index].show = show;
                    this.options[index].css = 'minus';
                }
            },

            operation: function(action) {
                if (action.indexOf('delete') >= 0) {
                    if (!confirm('" . Yii::t('System', 'common_delete_confirm') . "')) {
                        return false;
                    }
                }
                window.location.href = action;
            }
        }
    });

    app.init(app.categories, 0);

"
); ?>
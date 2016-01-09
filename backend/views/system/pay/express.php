<?php
/**
 * @name: SailShop System
 * @author: 游梦惊园
 * @link: https://github.com/duanbiaowu/sailshop
 * @blog: http://www.cnblogs.com/duanbiaowu
 * @copyright: Copyright (c) 2016 SailShop System
 * @date: 2015-11-06
 */

use yii\helpers\Html;
use yii\grid\GridView;

$this->title = '快递公司';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="express-company-index">

	<?php // echo $this->render('_search', ['model' => $searchModel]); ?>

	<p>
		<?= Html::a('创建快递公司', ['create'], ['class' => 'btn btn-success']) ?>
	</p>

	<?= GridView::widget([
		'dataProvider' => $dataProvider,
		'filterModel' => $searchModel,
		'columns' => [
			['class' => 'yii\grid\SerialColumn'],
			'名称',
			'标识符',
			'代码',
			'网址',
			['class' => 'yii\grid\ActionColumn'],
		],
	]); ?>

</div>

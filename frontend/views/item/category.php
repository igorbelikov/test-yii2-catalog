<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $model common\models\Tree */

$this->title = Yii::t('app', $model->name);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Categories'), 'url' => ['index']];
foreach ($model->parents()->all() as $parent) {
    $this->params['breadcrumbs'][] = ['label' => $parent->name, 'url' => ['category', 'id' => $parent->id]];
}
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="items-category">
	<h1><?= Yii::t('app', 'Categories') ?></h1>
	<?= $this->render('_nav', [
		'dataProvider' => $dataProvider
	]) ?>
	<hr>
	<h2>Items</h2>
	<div class="row">
		<div class="col-xs-12">
			<?= ListView::widget([
				'dataProvider' => $itemDataProvider,
				'itemView' => '_item',
				'layout' => "{summary}\n<div class=\"row\">{items}</div>\n{pager}",
			]) ?>
		</div>
	</div>
</div>
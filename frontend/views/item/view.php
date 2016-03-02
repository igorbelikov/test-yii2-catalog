<?php

/* @var $this yii\web\View */
use yii\bootstrap\Html;

/* @var $model common\models\Tree */

$this->title = Yii::t('app', $model->title);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Categories'), 'url' => ['index']];
foreach ($model->category->parents()->all() as $parent) {
	$this->params['breadcrumbs'][] = ['label' => $parent->name, 'url' => ['category', 'id' => $parent->id]];
}
$this->params['breadcrumbs'][] = ['label' => $model->category->name, 'url' => ['category', 'id' => $model->category->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="col-xs-4">
	<div class="thumbnail">
		<?php foreach ($model->getItemFiles()->all() as $file): ?>
			<?= Html::img($file->getFileUrl(), ['class' => 'img-responsive']) ?>
		<?php endforeach; ?>
		<div class="caption">
			<h1><?= $model->title ?></h1>
			<p><?= $model->content ?></p>
		</div>
	</div>
</div>
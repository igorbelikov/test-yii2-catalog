<?php

/* @var $this yii\web\View */
use yii\bootstrap\Html;

/* @var $model common\models\Tree */

?>
<div class="col-xs-4">
	<div class="thumbnail">
		<?php $preview = $model->getItemFiles()->preview()->one() ?>
		<?php if ($preview): ?>
			<?= Html::img($preview->getFileUrl(), ['class' => 'img-responsive']) ?>
		<?php endif; ?>
		<div class="caption">
			<h3><?= Html::a($model->title, ['item/view', 'id' => $model->id]) ?></h3>
			<p><?= $model->content ?></p>
		</div>
	</div>
</div>
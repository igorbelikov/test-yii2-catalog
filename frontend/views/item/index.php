<?php

use yii\bootstrap\Nav;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */

$this->title = Yii::t('app', 'Categories');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="items-index">
	<h1><?= $this->title ?></h1>
	<?= $this->render('_nav', [
		'dataProvider' => $dataProvider
	]) ?>
</div>
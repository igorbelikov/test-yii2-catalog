<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $model common\models\Tree */

echo ListView::widget([
	'dataProvider' => $dataProvider,
	'itemView' => function ($model, $key) {
		return Html::a($model->name, ['/item/category', 'id' => $key]);
	}
]);

// echo Nav::widget([
// 	'items' => ArrayHelper::toArray($dataProvider->getModels(), [
// 		'common\models\Tree' => [
// 			'label' => 'name',
// 			'url' => function ($model) {
// 				return ['category', 'id' => $model->id];
// 			}
// 		]
// 	]),
// 	'options' => ['class' =>'nav-pills']
// ]); 

?>
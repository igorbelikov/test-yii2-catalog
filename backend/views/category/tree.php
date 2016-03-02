<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Tree */

$this->title = Yii::t('app', 'Tree');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tree-create">

    <h1><?= Html::encode($this->title) ?></h1>
    
    <p>
        <?= Html::a(Yii::t('app', 'Admin'), ['index'], ['class' => 'btn btn-primary']) ?>
    </p>

	<?= $this->render('@gilek/gtreetable/views/widget', ['options' => [
	    'manyroots' => true, 
	    'draggable' => true
	]]) ?>

</div>

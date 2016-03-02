<?php

use kartik\file\FileInput;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use common\models\Tree;
use common\models\ItemFile;

/* @var $this yii\web\View */
/* @var $model common\models\Item */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="item-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

	<?= $form->field($model, 'images')->widget(FileInput::classname(), [
	    'options' => [
            'accept' => 'image/*', 
            'multiple' => true,
            'pluginOptions' => [
                'showRemove' => false,
                'showUpload' => false,
                'showCaption' => false,
                'initialPreview' => ItemFile::getInitialPreview($model),
                'initialPreviewConfig' => ItemFile::getInitialPreviewConfig($model),
            ],
        ],
	]) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'category_id')->dropDownList(ArrayHelper::map(Tree::find()->all(), 'id', 'name'), ['prompt' => '-']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

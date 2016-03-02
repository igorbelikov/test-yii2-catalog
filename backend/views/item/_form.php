<?php

use kartik\file\FileInput;
use yii\bootstrap\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use common\models\Tree;
use common\models\ItemFile;

/* @var $this yii\web\View */
/* @var $model common\models\Item */
/* @var $form yii\widgets\ActiveForm */
?>

<?php
$this->registerJs("
function setItemImagePreview(el) {
    $.post('" . Url::to(['file/set-item-image-preview']) . "', { id: $(el).data('key') }, function(data) {
        $('.b-item-image-preview').removeClass('b-item-image-preview');
        $(el).closest('.file-preview-frame').addClass('b-item-image-preview');
    }, 'json');
}
", \yii\web\View::POS_HEAD);
?>

<div class="item-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

	<?= $form->field($model, 'images[]')->widget(FileInput::classname(), [
	    'options' => [
            'accept' => 'image/*',
            'multiple' => true,
        ],
        'pluginOptions' => [
            'maxFileCount' => 5,
            'showRemove' => false,
            'showUpload' => false,
            'showCaption' => false,
            'overwriteInitial' => false,
            'initialPreview' => ItemFile::getInitialPreview($model),
            'initialPreviewConfig' => ItemFile::getInitialPreviewConfig($model),
            'otherActionButtons' => '<button onclick="setItemImagePreview(this)" type="button" class="btn btn-default btn-xs js-set-item-image-preview" {dataKey}><span class="glyphicon glyphicon-star"></span></button>'
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
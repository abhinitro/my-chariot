<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Page */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="page-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?=$form->field($model, 'description')->widget(\dosamigos\ckeditor\CKEditor::className(), ['options' => ['rows' => 6],'preset' => 'full'])?>
	
	<?php
$type = $model->gettypeOption();

if (! $model->isNewRecord) {
    if (! array_key_exists($model->type_id, $type)) {
        echo $form->field($model, 'state_id')->dropDownList($model->getStateOptions());
    }
} else {
    echo $form->field($model, 'state_id')->dropDownList($model->getStateOptions());
}
?>
    

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

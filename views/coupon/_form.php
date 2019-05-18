<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Coupon */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="coupon-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->widget(\dosamigos\ckeditor\CKEditor::className(), [
        'options' => ['rows' => 6],
        'preset' => 'full'
    ]) ?>


    <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'discount')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'max_discount')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'max_use')->textInput() ?>

    <?= $form->field($model, 'start_date')->widget(
        DatePicker::className(), [
        // inline too, not bad
        // modify template for custom rendering
        'clientOptions' => [
            'format' => 'yyyy-mm-dd'
        ]
    ]);?>

    <?= $form->field($model, 'end_date')->widget(
        DatePicker::className(), [
        // inline too, not bad
        'clientOptions' => [
            'format' => 'yyyy-mm-dd'
        ]
    ]);?>

    <?= $form->field($model, 'state_id')->dropDownList($model->getStateOption()) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

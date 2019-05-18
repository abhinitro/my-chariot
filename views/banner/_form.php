<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model app\models\Banner */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="banner-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?=$form->field($model, 'description')->widget(\dosamigos\ckeditor\CKEditor::className(), ['options' => ['rows' => 6],'preset' => 'full'])?>
    
    <?php
				echo $form->field ( $media, 'file_name' )->widget ( FileInput::classname (), [ 
						'options' => [ 
								'accept' => 'image/*' 
						] 
				] )->label ( 'Brand Image' );
				?>

    <?= $form->field($model, 'state_id')->dropDownList($model->getStateOptions()) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

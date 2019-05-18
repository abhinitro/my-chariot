<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\components\BasePageHeader;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model app\models\Deal */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="deal-form">

	
		<?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
    
    <?php
				echo $form->field ( $media, 'file_name[]' )->widget ( FileInput::classname (), [ 
						'options' => [ 
								'accept' => 'image/*',
								'multiple' => true 
						] 
				] )->label ( 'Deal Images' );
				?>

    <?= $form->field($model, 'state_id')->dropDownList($model->getStateOptions()) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
		</div>


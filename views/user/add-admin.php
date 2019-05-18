<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">
   <div class="col-md-8">
    <?php $form = ActiveForm::begin(['action'=>Url::toRoute('/user/add-admin')]); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
     <?= $form->field($model, 'full_name')->textInput(['maxlength' => true]) ?>


    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>
    
      <?= $form->field($model, 'confirm_password')->passwordInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

   

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Signup') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
</div>

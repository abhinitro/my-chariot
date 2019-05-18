<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;
/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = Yii::t ( 'app', 'Change Password' );
$this->params ['breadcrumbs'] [] = [
    'label' => Yii::t ( 'app', 'Change Password' ),
    'url' => [
        'index'
    ]
];
$this->params ['breadcrumbs'] [] = $this->title;
?>
<div class="user-create">
    <div class="panel">
        <div class="panel-body">
            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'newPassword')->passwordInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'confirm_password')->passwordInput(['maxlength' => true]) ?>






            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Change Password') : Yii::t('app', 'Change Password'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>

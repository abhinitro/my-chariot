<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
?>
<div id="home"  >
    <!-- container -->
    <div class="container">
        <!-- home wrap -->
        <div class="home-wrap">
            <!-- home slick -->
            <div id="home-slick">
<div class="user-form">
	<div class="col-md-8">
    <?php $form = ActiveForm::begin(['action'=>Url::toRoute('/user/signup')]); ?>

        <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'full_name')->textInput(['maxlength' => true]) ?>
        <?php if(\Yii::$app->controller->action->id !='update'){ ?>

            <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'confirm_password')->passwordInput(['maxlength' => true]) ?>
        <?php }?>


        <?php
        echo $form->field($model, 'profile_image')->widget(\kartik\file\FileInput::classname(), [
            'options' => ['accept' => 'image/*'],
            'pluginOptions' => [
                'initialPreviewShowDelete' => false,
                'overwriteInitial'=>true,


            ]

        ]);
        ?>


        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>
            </div>
        </div>
    </div>

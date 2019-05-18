<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = 'Sign In';

$fieldOptions1 = [ 
		'options' => [ 
				'class' => 'form-group has-feedback' 
		],
		'inputTemplate' => "{input}<span class='glyphicon glyphicon-envelope form-control-feedback'></span>" 
];

$fieldOptions2 = [ 
		'options' => [ 
				'class' => 'form-group has-feedback' 
		],
		'inputTemplate' => "{input}<span class='glyphicon glyphicon-lock form-control-feedback'></span>" 
];
?>

<section class="flat-account background">
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<div class="form-login">
					<div class="title">
						<h3><?= \Yii::t('app', 'Login')?></h3>
					</div>
					<div class="login-box-body">

        <?php $form = ActiveForm::begin(['id' => 'login-form', 'enableClientValidation' => false]); ?>

        <?=$form->field ( $model, 'username', $fieldOptions1 )->label ( false )->textInput ( [ 'placeholder' => \Yii::t('app', 'Email Address') ] )?>

        <?=$form->field ( $model, 'password', $fieldOptions2 )->label ( false )->passwordInput ( [ 'placeholder' => $model->getAttributeLabel ( 'password' ) ] )?>

        <div class="row">
							<div class="col-xs-8">
                <?= $form->field($model, 'rememberMe')->checkbox() ?>
            </div>
							<!-- /.col -->
							<div class="col-xs-4">
                <?= Html::submitButton('Sign in', ['class' => 'btn btn-primary btn-block btn-flat', 'name' => 'login-button']) ?>
            </div>
							<!-- /.col -->
						</div>


        <?php ActiveForm::end(); ?>
		<!-- /.social-auth-links -->



						<div class="change-anchor">
							<a href="#"><?= \Yii::t('app', 'I forgot my password') ?></a>
						</div>

						<div class="login-or">
			<?= \Yii::t('app', 'OR') ?>
		</div>
						<hr />

						<div class="social-login">
							<div>
        		<?=yii\authclient\widgets\AuthChoice::widget ( [ 'baseAuthUrl' => [ 'user/auth' ],'popupMode' => false ] )?>
        	</div>
							<div></div>
						</div>
					</div>
					<!-- /#form-login -->
				</div>
				<!-- /.form-login -->
			</div>
			<div class="col-md-6">
				<div class="form-register">
					<div class="title">
						<h3><?= \Yii::t('app', 'Register')?></h3>
					</div>
					<?php $form = ActiveForm::begin(['action'=>Url::toRoute('/user/signup')]); ?>

        <?= $form->field($userModel, 'email', $fieldOptions1)->textInput(['maxlength' => true,  'placeholder' => \Yii::t('app', 'Email Address') ])->label ( false )?>
        
        <?= $form->field($userModel, 'full_name', $fieldOptions1)->textInput(['maxlength' => true,  'placeholder' => \Yii::t('app', 'Full Name') ])->label ( false )?>
                <?= $form->field($userModel, 'username', $fieldOptions1)->textInput(['maxlength' => true,  'placeholder' => \Yii::t('app', 'User Name') ])->label ( false )?>
        
        <?= $form->field($userModel, 'password', $fieldOptions2)->passwordInput(['maxlength' => true,  'placeholder' => \Yii::t('app', 'Password') ])->label ( false )?>

        <?= $form->field($userModel, 'confirm_password', $fieldOptions2)->passwordInput(['maxlength' => true,  'placeholder' => \Yii::t('app', 'Confirm Password') ])->label ( false )?>

        <div class="form-group">
                <?= Html::submitButton('Sign Up', ['class' => 'btn btn-primary btn-block btn-flat', 'name' => 'login-button']) ?>
        </div>

        <?php ActiveForm::end(); ?>
					<!-- /#form-register -->
				</div>
				<!-- /.form-register -->
			</div>
			<!-- /.col-md-6 -->
		</div>
		<!-- /.row -->
	</div>
	<!-- /.container -->
</section>
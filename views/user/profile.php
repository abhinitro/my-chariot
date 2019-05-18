<?php
use yii\widgets\ActiveForm;
use yii\bootstrap\Html;

$auth = \app\models\Auth::findOne ( [ 
		'user_id' => $model->id 
] );

?>
<style>
body {
	padding-top: 30px;
}

.glyphicon {
	margin-bottom: 10px;
	margin-right: 10px;
}

small {
	display: block;
	line-height: 1.428571429;
	color: #999;
}
</style>
<!------ Include the above in your HEAD tag ---------->
<div id="home" style="margin-top: 42px;">
	<!-- container -->
	<div class="container">
		<!-- home wrap -->
		<div class="home-wrap">
			<!-- home slick -->
			<div id="home-slick">
				<div class="container">
					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-12">
							<div class="well well-sm">
								<div class="row">
									<div class="col-sm-6 col-md-4">
                        <?php  if(!empty($auth)){?>
                        <img
											src="<?php
																									$var = explode ( '?', $model->profile_image );
																									echo $var [0];
																									?>"
											alt="" class="img-rounded img-responsive" />

                        <?php }else{?>



                        <?php echo $model->profileImage();  }?>


                    </div>
									<div class="col-sm-6 col-md-8">
                        <?php
																								
$form = ActiveForm::begin ( [ 
																										'method' => 'post',
																										'action' => [ 
																												'edit-profile',
																											'id'=>$model->id
																										] 
																								
																								] );
																								?>
                       
<?= $form->field($model, 'email')->textInput(['value' => $model->email,'readonly'=>true]) ?>
<?= $form->field($model, 'full_name')->textInput(['value' => $model->full_name]) ?>
<?= $form->field($model, 'contact_no')->textInput(['value' => $model->contact_no]) ?>
<?= $form->field($model, 'address')->textInput(['value' => $model->address]) ?>
<?= $form->field($model, 'profile_image')->fileInput() ?>

        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>



                    <?php ActiveForm::end()?>
                        </div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

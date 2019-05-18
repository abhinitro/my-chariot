<!-- <script type="text/javascript"
	src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBtRmXKclfDp20TvfQnpgXSDPjut14x5wk&region=GB"></script> -->

<!-- <section class="flat-map"> -->
<!-- 	<div class="container"> -->
<!-- 		<div class="row"> -->
<!-- 			<div class="col-md-12"> -->
<!-- 				<div id="flat-map" class="pdmap"> -->
<!-- 					<div class="flat-maps" data-address="Quận Smith, Mississippi" -->
<!-- 						data-height="444" data-images="images/icons/map.png" -->
<!-- 						data-name="Themesflat Map"></div> -->
<!-- 					<div class="gm-map"> -->
<!-- 						<div class="map"></div> -->
<!-- 					</div> -->
<!-- 				</div> -->
<!-- /#flat-map -->
<!-- 			</div> -->
<!-- /.col-md-12 -->
<!-- 		</div> -->
<!-- /.row -->
<!-- 	</div> -->
<!-- /.container -->
<!-- </section> -->
<!-- /#flat-map -->
<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
?>
<section class="flat-contact style2">
	<div class="container">
		<div class="row">
			<div class="col-md-7">
				<div class="form-contact left">
					<div class="form-contact-header">
						<h3>Leave us a Message</h3>
						<p>Maecenas dolor elit, semper a sem sed, pulvinar molestie lacus.
							Aliquam dignissim, elit non mattis ultrices, neque odio ultricies
							tellus, eu porttitor nisl ipsum eu massa.</p>
					</div>
					<!-- /.form-contact-header -->
					<div class="form-contact-content">
					<?php
					
$form = ActiveForm::begin ( [
							'id'=>"form-contact",
							'fieldConfig' => [ 
									'options' => [ 
											'tag' => false 
									] 
							] 
					] );
					?>
						<!-- <form action="#" method="get" id="form-contact"
							accept-charset="utf-8"> -->
							<div class="row">
							<div class="col-md-6">
								<label for="name-contact">First name*</label> 
								<?= $form->field($model, 'firstName',['options' => ['id' => 'name-contact','class'=>'']])->textInput(['maxlength' => true])->label(false)?>
								
							</div>
							<div class="col-md-6">

								<label for="password-contact">Last name*</label>
								<?= $form->field($model, 'lastName')->textInput(['maxlength' => true])->label(false)?>
							</div>
							</div>
							<div class="row">
							<div class="col-md-6">
								<label for="name-contact">Email*</label> 
								<?= $form->field($model, 'email')->textInput(['maxlength' => true])->label(false)?>
								
							</div>
							<div class="col-md-6">

								<label for="password-contact">Contact*</label>
								<?= $form->field($model, 'contact')->textInput(['maxlength' => true])->label(false)?>
								 
							</div>
							</div>
							<div class="form-box">
								<label for="subject-contact">Subject</label> 
								<?= $form->field($model, 'subject')->textInput(['maxlength' => true])->label(false)?>
								
							</div>
							<div class="form-box">
								<label for="comment-contact">Comment</label>
								<?= $form->field($model, 'body')->textArea ( [ 'rows' => 6,'placeholder' => 'Message' ] )->label ( false )?>
								
							</div>
							<div class="form-box">
							  <?=Html::submitButton ( 'Submit', [ 'class' => 'contact','name' => 'submit-button' ] )?>
								
							</div>
							<?php ActiveForm::end(); ?>
						</form>
						<!-- /#form-contact -->
					</div>
					<!-- /.form-contact-content -->
				</div>
				<!-- /.form-contact left -->
			</div>
			<!-- /.col-md-7 -->
			<div class="col-md-5">
				<div class="box-contact">
					<ul>
						<li class="address">
							<h3>Address</h3>
							<p>
								PO Box CT16122 Collins Street West, <br />Victoria 8007,
								Australia.
							</p>
						</li>
						<li class="phone">
							<h3>Phone</h3>
							<p>(888) 123 456 789</p>
							<p>(888) 589 658 23</p>
						</li>
						<li class="email">
							<h3>Email</h3>
							<p>info@technostore.com</p>
						</li>
						<li class="address">
							<h3>Opening Hours</h3>
							<p>Monday to Friday: 10am to 6pm</p>
							<p>Saturday: 10am to 4pm</p>
							<p>Sunday: 12am t0 4pm</p>
						</li>
						<li>
							<h3>Follow Us</h3>
							<ul class="social-list style2">
								<li><a href="#" title=""> <i class="fa fa-facebook"
										aria-hidden="true"></i>
								</a></li>
								<li><a href="#" title=""> <i class="fa fa-twitter"
										aria-hidden="true"></i>
								</a></li>
								<li><a href="#" title=""> <i class="fa fa-instagram"
										aria-hidden="true"></i>
								</a></li>
								<li><a href="#" title=""> <i class="fa fa-pinterest"
										aria-hidden="true"></i>
								</a></li>
								<li><a href="#" title=""> <i class="fa fa-dribbble"
										aria-hidden="true"></i>
								</a></li>
								<li><a href="#" title=""> <i class="fa fa-google"
										aria-hidden="true"></i>
								</a></li>
							</ul> <!-- /.social-list style2 -->
						</li>
					</ul>
				</div>
				<!-- /.box-contact -->
			</div>
			<!-- /.col-md-5 -->
		</div>
		<!-- /.row -->
	</div>
	<!-- /.container -->
</section>
<!-- /.flat-contact style2 -->

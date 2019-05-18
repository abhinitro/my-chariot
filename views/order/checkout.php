


<?php
use yii\helpers\Url;
use yii\helpers\Html;
use app\models\User;
use app\models\Cart;
use yii\widgets\ActiveForm;
?>
<!-- BREADCRUMB -->
<div id="breadcrumb">
	<div class="container">
		<ul class="breadcrumb">
			<li><a href="#">Home</a></li>
			<li class="active">Checkout</li>
		</ul>
	</div>
</div>
<!-- /BREADCRUMB -->

<!-- section -->
<div class="section">
	<!-- container -->
	<div class="container">
	
	
		<!-- row -->
		<div class="row">
		
		
			<div class="col-md-12">
				<div class="order-summary clearfix">
					<div class="section-title">
						<h3 class="title">Order Review</h3>
					</div>
					<table class="shopping-cart-table table">
						<thead>
							<tr>
								<th>Product</th>
								<th></th>
								<th class="text-center">Price</th>
								<th class="text-center">Quantity</th>
								<th class="text-center">Total</th>
								<th class="text-right"></th>
							</tr>
						</thead>
						<tbody>
<?= \Yii::$app->controller->renderPartial('order-list',['dataProvider'=>$dataProvider])?>
</tbody>
						<tfoot>
							<tr>
									<th class="empty" colspan="3"></th>
								<th>SUBTOTAL</th>
								<th colspan="2" class="sub-total">$<span id="sub_total"><?php echo Cart::getTotal()?></span></th>
							</tr>
							<tr>
								<th class="empty" colspan="3"></th>
								<th>SHIPING</th>
								<td colspan="2">Free Shipping</td>
							</tr>
							<tr>
								<th class="empty" colspan="3"></th>
								<th>TOTAL</th>
								<th colspan="2" class="total">$<span id="total_amount"><?php echo Cart::getTotal()?></span></th>
							</tr>
						</tfoot>
					</table>

				</div>
				
			</div>
		
		
			<!-- 			<form id="" class="clearfix"> -->
								<?php
								
								$form = ActiveForm::begin ( [ 
										/*
										 * 'fieldConfig' => [
										 * 'options' => [
										 * 'tag' => false
										 * ]
										 * ],
										 */
										'id' => "checkout-form",
										'class' => "clearfix" 
								] );
								?>
				<div class="col-md-6">
				<div class="billing-details">
					<?php if(empty ( \Yii::$app->user->identity )){?>
						<p>
						Already a customer ? <a
							href="<?= Url::toRoute(['/user/login']) ?>"><?=\yii::t('app','Login')?></a>
					</p>
						<?php }?>
						<div class="section-title">
						<h3 class="title">Billing Details</h3>
					</div>
						<?= $form->field($model, 'firstName')->textInput(['maxlength' => true,'placeholder'=>"First Name"])->label(false)?>
						
						<?= $form->field($model, 'lastName')->textInput(['maxlength' => true,'placeholder'=>"Last Name"])->label(false)?>
						
						<?= $form->field($model, 'email')->textInput(['maxlength' => true,'placeholder'=>"Email"])->label(false)?>
						
						<?= $form->field($model, 'address')->textInput(['maxlength' => true,'placeholder'=>"Address"])->label(false)?>
						
					    <?= $form->field($model, 'latitude')->hiddenInput(['maxlength' => true,'placeholder'=>"Address"])->label(false)?>
						<?= $form->field($model, 'longitude')->hiddenInput(['maxlength' => true,'placeholder'=>"Address"])->label(false)?>
						

						<?= $form->field($model, 'city')->textInput(['maxlength' => true,'placeholder'=>"City" ,'id'=>'city'])->label(false)?>
						
						<?= $form->field($model, 'country')->textInput(['maxlength' => true,'placeholder'=>"Country"  , 'id'=>'country'])->label(false)?>
						
						
						<?= $form->field($model, 'zip')->textInput(['maxlength' => true,'placeholder'=>"ZIP Code" ,'id'=>"postal_code"])->label(false)?>
						
						<?= $form->field($model, 'contact_no')->textInput(['maxlength' => true,'placeholder'=>"Telephone"])->label(false)?>
						.
						<?= $form->field($model, 'amount')->hiddenInput(['value'=>Cart::getTotal()])->label(false)?>
						
						<!-- <div class="form-group">
							<div class="input-checkbox">
								<input type="checkbox" id="register"> <label class="font-weak"
									for="register">Create Account?</label>
								<div class="caption">
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit,
										sed do eiusmod tempor incididunt.
									
									
									<p>
										<input class="input" type="password" name="password"
											placeholder="Enter Your Password">
								
								</div>
							</div>
						</div> -->
				</div>
			</div>

			<div class="col-md-6">
				<div class="shiping-methods">
					<div class="section-title">
						<h4 class="title">Shiping Methods</h4>
					</div>
					<div class="input-checkbox">
						<input type="radio" name="shipping" id="shipping-1" checked> <label
							for="shipping-1">Free Shiping - $0.00</label>
						<div class="caption">
<!-- 							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed -->
<!-- 								do eiusmod tempor incididunt ut labore et dolore magna aliqua. -->
<!-- 								Ut enim ad minim veniam, quis nostrud exercitation ullamco -->
<!-- 								laboris nisi ut aliquip ex ea commodo consequat. -->
							
							
<!-- 							<p> -->
						
						</div>
					</div>
					<div class="input-checkbox">
						<input type="radio" name="shipping" id="shipping-2"> <label
							for="shipping-2">Standard - $4.00</label>
						<div class="caption">
							<!-- 							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed -->
							<!-- 								do eiusmod tempor incididunt ut labore et dolore magna aliqua. -->
							<!-- 								Ut enim ad minim veniam, quis nostrud exercitation ullamco -->
							<!-- 								laboris nisi ut aliquip ex ea commodo consequat. -->


							<!-- 							<p> -->

						</div>
					</div>
				</div>

				<div class="payments-methods">
					<div class="section-title">
						<h4 class="title">Payments Methods</h4>
					</div>
					<div class="input-checkbox">
						<input type="radio" name="payments" id="payments-1" checked> <label
							for="payments-1">Direct Bank Transfer</label>
						<div class="caption">
							<!-- 							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed -->
							<!-- 								do eiusmod tempor incididunt ut labore et dolore magna aliqua. -->
							<!-- 								Ut enim ad minim veniam, quis nostrud exercitation ullamco -->
							<!-- 								laboris nisi ut aliquip ex ea commodo consequat. -->


							<!-- 							<p> -->

						</div>
					</div>
					<div class="input-checkbox">
						<input type="radio" name="payments" id="payments-2"> <label
							for="payments-2">Cheque Payment</label>
						<div class="caption">
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed
								do eiusmod tempor incididunt ut labore et dolore magna aliqua.
								Ut enim ad minim veniam, quis nostrud exercitation ullamco
								laboris nisi ut aliquip ex ea commodo consequat.
							
							
							<p>
						
						</div>
					</div>
					<div class="input-checkbox">
						<input type="radio" name="payments" id="payments-3"> <label
							for="payments-3">Paypal System</label>
						<div class="caption">
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed
								do eiusmod tempor incididunt ut labore et dolore magna aliqua.
								Ut enim ad minim veniam, quis nostrud exercitation ullamco
								laboris nisi ut aliquip ex ea commodo consequat.
							
							
							<p>
						
						</div>
					</div>
				</div>
			</div>
		<div class="pull-right">
						<?=Html::submitButton ( 'Place Order', [ 'class' => 'primary-btn','name' => 'submit-button' ] )?>
							<!-- <button class="primary-btn">Place Order</button> -->
				</div>
				<?php ActiveForm::end(); ?>
<!-- 			</form> -->
		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</div>
<!-- /section -->

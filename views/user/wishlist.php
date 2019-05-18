<?php
use yii\helpers\Url;
use yii\widgets\ActiveForm;

?>
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

								<th class="text-center">Add To Cart</th>
								<th class="text-center">Total</th>
								<th class="text-right"></th>
							</tr>
						</thead>
						<tbody>
							<tr>
							
							<?php
							
							foreach ( $wishlists as $wish ) {
								
								if(!empty($wish->product)){
								?>
							    
							    
							    
								<td class="thumb"><?=$wish->product->getImageFile($wish->product,'user.png',['alt'=>$wish->product->title])?></td>
								<td class="details"><a
									href="<?=Url::toRoute(['product/detail','slug'=>$wish->product->slug]) ?>"><?=$wish->product->title; ?></a>
								</td>
								<td class="price text-center"><strong>$<?=$wish->product->getDiscountPrice()?></strong><br> 
								<?php if(!empty($wish->product->discount)){ ?>
								<del class="font-weak">
										<small><?= $wish->product->amount?></small>
									</del>
									<?php }?>
									
									</td>
								<td class="qty text-center"><button
										class="primary-btn add-to-cart"
										id="add_to_cart_<?=$wish->product->id ?>"
										data-id='<?=$wish->product->id ?>'
										data-amount="<?=$wish->product->getDiscountPrice()?>">
										<i class="fa fa-shopping-cart"></i> <?=\yii::T('app','Add to Cart')?>
							</button></td>
								<td class="total text-center"><strong class="primary-color">$<?=$wish->product->amount; ?></strong></td>
								<td class="text-right">
								 <?php
								
								$form = ActiveForm::begin ( [ 
										'action' => [ 
												
												'cart/delete-from-wishlist',
												'id' => $wish->id 
										
										],
										'method' => 'post' 
								] );
								?>
					
					<button class="main-btn icon-btn" type="submit">
										<i class="fa fa-close"></i>
									</button>
<?php ActiveForm::end()?>		
								
								
								</td>
							</tr>
							<?php  }} ?>

						</tbody>
					</table>

				</div>

			</div>

		</div>
	</div>
</div>
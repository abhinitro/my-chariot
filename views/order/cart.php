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

								<th class="text-center">Quantity</th>
								<th class="text-center">Total</th>
								<th class="text-right"></th>
							</tr>
						</thead>
						<tbody>
							<tr>
							
							<?php foreach ($carts as $cart){?>
							
							<td class="thumb"><img
		src="<?= \Yii::$app->view->theme->getUrl('/frontend') ?>/img/thumb-product01.jpg"
		alt=""></td>
	<td class="details"><a href="#"><?php echo $cart->product->title?></a>
		<ul>
			<li><span>Size: XL</span></li>
			<li><span>Color: Camelot</span></li>
		</ul></td>
										<?php if($cart->product->discount>0){?>
									<td class="price text-center"><strong><span>$</span><span
			id="<?php echo $cart->id?>"><?php echo $cart->product->getDiscountPrice()?></span></strong><br>
		<del class="font-weak">
			<small>$<?php echo $cart->product->amount?></small>
		</del></td>
										<?php }else{?>
										<td class="price text-center"><strong><span>$</span><span
			id="<?php echo $cart->id?>"><?php echo $cart->product->amount?></span></strong><br>
										<?php }?>
									
	
	<td class="qty text-center"><input class="input"
		id="quantity_<?php echo $cart->id?>" text="<?php echo $cart->id?>"
		type="number" value="<?php echo $cart->quantity?>" oldValue="<?php echo $cart->quantity?>" min="1"></td>
	<td class="total text-center"><strong class="primary-color"
		id="total-amount_<?php echo $cart->id?>">$<?php echo $cart->product->getDiscountPrice()*$cart->quantity ?></strong></td>
							
							
										<td class="text-right">
								 <?php
								
								$form = ActiveForm::begin ( [ 
										'action' => [ 
												
												'cart/delete-from-cart',
												'id' => $cart->id 
										
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
							<?php }?>

						</tbody>
					</table>
					<div class="pull-right">
						<a href="<?= Url::toRoute(['/order/checkout']) ?>"
							class="primary-btn">Checkout</a>
					</div>
				</div>

			</div>

		</div>
	</div>
</div>


<script>

$('[id^=quantity_]').on('change',function(){
	var id=$(this).attr('text');
	var oldValue=$(this).attr('oldValue');
	var quantity=this.value;
	
	var myKeyVals = { id : id, count : quantity}
	$.ajax({
	    type: "POST",
	    url: '<?= Url::toRoute(['/cart/update-quantity']) ?>',
	    data:myKeyVals
	    });
	var amount=parseFloat($("#"+id).text());
	
	var old_amount=amount*oldValue;
	var new_amount=amount*quantity;
	var total_amount=amount*quantity;
	$("#total-amount_"+id).text("$"+total_amount.toFixed(2));	
	var sub=parseFloat($("#sub_total").text());
	
	//$(this).setAttribute('oldValue',quantity);
	$(this).attr('oldValue',quantity);
	sub=sub+new_amount-old_amount;
	
	$("#sub_total").text(sub.toFixed(2));
	$("#order-amount").value=sub.toFixed(2);
	$("#total_amount").text(sub.toFixed(2));
});



</script>
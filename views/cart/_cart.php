<?php
use yii\helpers\Url;
use app\models\Cart;
use yii\widgets\ActiveForm;
$models = (new Cart())->getCartItems();
$counts = count($models);
?>
<li class="header-cart dropdown default-dropdown"><a
	class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
		<div class="header-btns-icon">
			<i class="fa fa-shopping-cart"></i> <span class="qty"
				id="quantity-of-product"><?=$counts?></span>
		</div>
</a>
	<div class="custom-menu">
		<div id="shopping-cart">
			<div class="shopping-cart-list" id="add-cart-list">
									<?php if(!empty($models)){?>
										
										<?php
            
            foreach ($models as $model) {
                if (isset($model->product)) {
                    ?>
										<div class="product product-widget">
					<div class="product-thumb">
												            <?= $model->product->getImageFile($model->product,'user.png',['alt'=>$model->product->title])?>

											</div>
					<div class="product-body">
						<h3 class="product-price">
					<?=$model->product->getDiscountPrice()?> <span class="qty"
								id="qty_<?=$model->id?>">x <?=$model->quantity?></span>
						</h3>
						<h2 class="product-name">
							<a href="#"><?=$model->product->title?></a>
						</h2>
					</div>
					    <?php
                    
                    $form = ActiveForm::begin([
                        'action' => [
                            
                            'cart/delete-from-cart',
                            'id' => $model->id
                        
                        ],
                        'method' => 'post'
                    ]);
                    ?>
					
					<button type="submit" class="cancel-btn">
						<i class="fa fa-trash"></i>
					</button>
<?php ActiveForm::end()?>					
				</div>
										<?php } } }?>
										
									</div>
			<div class="shopping-cart-btns">
				<a href="<?= Url::toRoute(['order/cart']) ?>" class="main-btn">View
					Cart</a> <a href="<?= Url::toRoute(['order/checkout']) ?>"
					class="primary-btn"> Checkout <i class="fa fa-arrow-circle-right"></i>
				</a>
			</div>
		</div>
	</div></li>

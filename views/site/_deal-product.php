<?php
use yii\helpers\Url;
use app\models\Wishlist;
?>
<div class="col-md-4">
	<div class="product product-single">
		<div class="product-thumb">



			<a class="main-btn quick-view btn"
				href="<?= Url::toRoute(['/product/detail','slug'=>$product->slug])?>">


				<i class="fa fa-search-plus"></i> <?=\yii::t('app','Quick views')?>
																	</a>
						
						            <?= $product->getImageFile($product,'default.jpg',['alt'=>$product->title])?>
						
					</div>
		<div class="product-body">
			<h3 class="product-price">
							  $<?=  $product->getDiscountPrice() ?>
                <?php if(!empty($product->discount)){?>
                <del class="product-old-price"><?= $product->amount?></del>
                <?php }?>
						</h3>
			<?php
echo $this->render("/review/ratting", [
    'id' => $product->id
]);
?>
			<div class="product-name">
				<a
					href="<?= Url::toRoute(['/product/detail','slug'=>$product->slug])?>"><?= $product->title  ?></a>
			</div>
			<div class="product-btns">
				<?=(new Wishlist())->add_to_wishlist($product) ?>
				<!-- <span> <a class="min" href="#sku367225"><span>-</span></a> <input
					class="text_box" value="1" name="new_item[quantity]"
					id="new_item_quantity" type="text"> <a class="add"
					href="#sku367225"><span>+</span></a>
				</span> -->
				<button class="primary-btn add-to-cart"
					id="add_to_cart_<?=$product->id ?>" data-id='<?=$product->id ?>'
					data-amount="<?=$product->getDiscountPrice()?>">
					<i class="fa fa-shopping-cart"></i><span class="mar-left-10"> Add
						to Cart </span>
				</button>
			</div>
		</div>
	</div>
</div>

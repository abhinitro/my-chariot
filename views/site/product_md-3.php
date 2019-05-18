<?php
use yii\helpers\Url;
use app\models\Wishlist;
?>

	<?php
$i = 0;	
if (! empty($latestDataProvider->models)) {
    
    foreach ($latestDataProvider->models as $key => $product) {
        if ($i == 0 || ($i%4 == 0)) {
        ?>
		<div class="col-md-12">
	<?php } ?>
    	<div class="col-md-3 col-sm-6 col-xs-6">
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
                    <?php if(!empty($product->discount)) { ?>
                    	<del class="product-old-price"><?= $product->amount?></del>
                    <?php } ?>
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
    				<!-- <button class="main-btn icon-btn">
    					<i class="fa fa-exchange"></i>
    				</button> -->
    					<button class="primary-btn add-to-cart"
    						id="add_to_cart_<?=$product->id ?>" data-id='<?=$product->id ?>'
    						data-amount="<?=$product->getDiscountPrice()?>">
    						<i class="fa fa-shopping-cart"></i> <span class="mar-left-10"> Add
    							to Cart </span>
    					</button>
    				</div>
    			</div>
    		</div>
    	</div>
	<?php $i++; if ($i == 0 || ($i%4 == 0) || ($i == count($latestDataProvider->models))) { ?>
		</div>
	<?php }  ?>
<?php }}?>

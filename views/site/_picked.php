<?php
use app\models\Wishlist;
use yii\helpers\Url;

?>

<div class="col-md-3 col-sm-6 col-xs-6">
	<div class="product product-single">
		<div class="product-thumb">
			<div class="product-label">
				<span>New</span>
			</div>

			<a class="main-btn quick-view btn"
				href="<?= Url::toRoute(['/product/detail','slug'=>$model->slug])?>">


				<i class="fa fa-search-plus"></i> <span class="mar-left-5"> <?=\yii::t('app','Quick views')?> </span>
			</a>
						            <?= $model->getImageFile($model, 'default.jpg', ['alt' => $model->title])?>
		
		</div>
		<div class="product-body">
<?php if($model->discount>0){?>
<h3 class="product-price">
$<?php echo $model->amount-$model->discount?>
					<del class="product-old-price">$<?php echo $model->amount?></del>
			</h3>

<?php }else{ ?>
<h3 class="product-price">$<?php echo $model->amount?></h3>
<?php }?>
<?php
echo $this->render("/review/ratting", [
    'id' => $model->id
]);
?>


			<div class="product-name">
				<a
					href="<?= Url::toRoute(['/product/detail','slug'=>$model->slug])?>"><?= $model->title  ?></a>
			</div>
			<div class="product-btns">
			<?=(new Wishlist())->add_to_wishlist($model)?>
				<!-- <button class="main-btn icon-btn">
					<i class="fa fa-heart"></i>
				</button> -->
				<!-- <button class="main-btn icon-btn">
					<i class="fa fa-exchange"></i>
				</button> -->
				<button class="primary-btn add-to-cart"
					id="add_to_cart_<?=$model->id ?>" data-id='<?=$model->id ?>'
					data-amount="<?=$model->getDiscountPrice()?>">
					<i class="fa fa-shopping-cart"></i><span class="mar-left-10"><?=\yii::t('app','Add to Cart')?></span>
				</button>
			</div>
		</div>
	</div>
</div>
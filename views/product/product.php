<?php
use app\models\Wishlist;
?>
<div class="col-md-4 col-sm-6 col-xs-6">
	<div class="product product-single">
		<div class="product-thumb">
			<div class="product-label">
				<span>New</span>
                <?php if(!empty($model->discount)) {?> 
                <span class="sale"><?= isset($model->discount)?$model->discount:'0'?>%</span>
                <?php }?>
            </div>
			<!-- 			<a class="main-btn quick-view"> -->
			<?= \yii\helpers\Html::a('	<i class="fa fa-search-plus"></i>Quick view',\yii\helpers\Url::toRoute(['detail','slug'=>$model->slug]),['class'=>'main-btn quick-view btn'])   ?>
<!--             </a> -->
            <?= $model->getImageFile($model,'user.png',['alt'=>$model->title])?>

        </div>
		<div class="product-body">
			<h3 class="product-price">
                $<?=  $model->getDiscountPrice() ?>
                <?php if(!empty($model->discount)){?>
                <del class="product-old-price"><?= $model->amount?></del>
                <?php }?>
            </h3>
            <?php 
						echo  $this->render("/review/ratting",['id'=>$model->id]);
						?>
			<!-- <div class="product-rating">
				<i class="fa fa-star"></i> <i class="fa fa-star"></i> <i
					class="fa fa-star"></i> <i class="fa fa-star"></i> <i
					class="fa fa-star-o empty"></i>
			</div> -->
			<h2 class="product-name">
				<a href="#"><?= $model->title  ?></a>
			</h2>
			<div class="product-btns">
				<?=(new Wishlist())->add_to_wishlist($model) ?>
				
				<button class="primary-btn add-to-cart"
					id="add_to_cart_<?=$model->id ?>" data-id='<?=$model->id ?>'
					data-amount="<?=$model->getDiscountPrice()?>">
					<i class="fa fa-shopping-cart"></i> Add to Cart
				</button>
			</div>
		</div>
	</div>
</div>
<!-- /Product Single -->

<!-- Product Single -->

<!-- /Product Single -->




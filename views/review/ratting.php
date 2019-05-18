<?php
use app\models\Review;
?>

<div>
						<div class="product-rating">
<?php $ratting=Review::find()->where(['product_id'=>$id])->average('ratings');$count=Review::find()->where(['product_id'=>$id])->count()?>
<?php $empty=5-floor($ratting); for($i=0;$i<floor($ratting);$i++){?>

<i class="fa fa-star"></i> <?php }?><?php for($j=0;$j<$empty;$j++){?><i
					class="fa fa-star-o empty"></i>
<?php }?>
</div><?php echo $count?> Review(s) 
</div>
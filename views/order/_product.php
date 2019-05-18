<?php
use yii\widgets\ActiveForm;
use yii\helpers\Url;

?>


<tr>
	<td class="thumb">						            <?= $model->product->getImageFile($model->product,'user.png',['alt'=>$model->product->title])?>
	</td>
	<td class="details"><a href="#"><?php echo $model->product->title?></a>
<!-- 		<ul> -->
<!-- 			<li><span>Size: XL</span></li> -->
<!-- 			<li><span>Color: Camelot</span></li> -->
<!-- 		</ul> -->
		</td>
										<?php if($model->product->discount>0){?>
									<td class="price text-center"><strong><span>$</span><span
			id="<?php echo $model->id?>"><?php echo $model->product->getDiscountPrice()?></span></strong><br>
		<del class="font-weak">
			<small>$<?php echo $model->product->amount?></small>
		</del></td>
										<?php }else{?>
										<td class="price text-center"><strong><span>$</span><span
			id="<?php echo $model->id?>"><?php echo $model->product->amount?></span></strong><br>
										<?php }?>
									
	
	
	
	<td class="qty text-center"><input class="input"
		id="quantity_<?php echo $model->id?>" text="<?php echo $model->id?>"
		type="number" value="<?php echo $model->quantity?>"
		oldValue="<?php echo $model->quantity?>" min="1"></td>
	<td class="total text-center"><strong class="primary-color"
		id="total-amount_<?php echo $model->id?>">$<?php echo $model->product->getDiscountPrice()*$model->quantity ?></strong></td>
	<td class="text-right"><a
		href="<?= Url::toRoute(['/cart/delete-from-cart','id'=>$model->id])?>"
		class="main-btn icon-btn" data-method="post"> <i class="fa fa-close"></i>
	</a></td>
</tr>



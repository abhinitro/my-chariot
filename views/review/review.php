<div class="single-review">
	<div class="review-heading">
		<div>
			<a href="#"><i class="fa fa-user-o"></i> <?=$model->name?></a>
		</div>
		<div>
			<a href="#"><i class="fa fa-clock-o"></i><?=\Yii::$app->formatter->asDatetime($model->created_on)?> </a>
		</div>
		<div class="review-rating pull-right">
		<?php for($i=1;$i<=5;$i++){?>
		
		<?php if($i<=$model->ratings){?>
			<i class="fa fa-star"></i>
			<?php }else{?>
			<i class="fa fa-star-o empty"></i>
			<?php }}?>
			 
		</div>
	</div>
	<div class="review-body">
		<p><?= $model->comments?></p>
	</div>
</div>



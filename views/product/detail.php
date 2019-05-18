<?php
use yii\widgets\ActiveForm;
use yii\helpers\Url;
?>
<style>
/*set a border on the images to prevent shifting*/
#product-main-view img {
	border: 2px solid white;
}

/*Change the colour*/
.active img {
	border: 2px solid #333 !important;
}
</style>

<div id="breadcrumb">
	<div class="container">
		<ul class="breadcrumb">
			<li><a href="<?= Url::home() ?>">Home</a></li>
			<li><a href="<?= Url::toRoute(['product/list']) ?>">Products</a></li>
			<li class="active"><?= isset($model->title)?$model->title:''?></li>
		</ul>
	</div>
</div>
<!-- /BREADCRUMB -->

<!-- section -->

<?php

if (! empty($model)) {
    $file = \app\modules\media\models\Media::find()->where([
        'model_id' => $model->id,
        'model_type' => get_class($model)
    ])->one();
    
    $files = \app\modules\media\models\Media::find()->where([
        'model_id' => $model->id,
        'model_type' => get_class($model)
    ])->all();
    
    ?>



<div class="section">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row">
			<!--  Product Details -->
			<div class="product product-details clearfix">
				<div class="col-md-6">
					
					<?php if( $file ) { ?>
					<img id="img_01"
						src="<?= \yii\helpers\Url::to(['/uploads']) ?><?= '/thumbnail/'.$file->thumb_file ?>"
						data-zoom-image="<?= \yii\helpers\Url::to(['/uploads']) ?><?= '/'.$file->file_name ?>" />
					<?php } ?>
					
					<div id="product-main-view">

                        <?php foreach($files as $file) { ?>
    						<a href="#"
							data-image="<?= \yii\helpers\Url::to(['/uploads']) ?><?= '/thumbnail/'.$file->thumb_file ?>"
							data-zoom-image="<?= \yii\helpers\Url::to(['/uploads']) ?><?= '/'.$file->file_name ?>">
							<img id="img_01" width="20%"
							src="<?= \yii\helpers\Url::to(['/uploads']) ?><?= '/thumbnail/'.$file->thumb_file ?>" />
						</a>
						<?php } ?>
					</div>

				</div>
				<div class="col-md-6">
					<div class="product-body">
						<div class="product-label">
							<span class="label label-info">New</span> <?php if(!empty($model->discount)){?>
							<span class="sale label label-info">-<?=  $model->discount ?>%</span><?php }?>
						</div>
						<h2 class="product-name"><?= $model->title?></h2>

						<h3 class="product-price">
							$<?= $model->getDiscountPrice()?>
							<?php if(!empty($model->discount)) {?>
							
							<del class="product-old-price"><?= $model->amount?></del>
													<?php }?>
							
						</h3>
						<!-- <div>
							<div class="product-rating">
								<i class="fa fa-star"></i> <i class="fa fa-star"></i> <i
									class="fa fa-star"></i> <i class="fa fa-star"></i> <i
									class="fa fa-star-o empty"></i>
							</div>
							<a href="#">3 Review(s) / Add Review</a>
						</div> -->
						<?php
    echo $this->render("/review/ratting", [
        'id' => $model->id
    ]);
    ?>
						<p>
							<strong>Availability:</strong> In Stock
						</p>
						<p>
							<strong>Brand:</strong> <?= $model->getTitleofBrand(); ?>
						</p>
						<p><?= !empty($model->description)?$model->description:'Not Available' ?></p>

						<div class="product-btns">
							<div class="qty-input">
								<span class="text-uppercase">QTY: </span>
							</div>
							<div class="qty-input-box">
								<input class="input" min='1' value="1" name="qty"
									id="product_qyt_<?=$model->id ?>" type="number">
							</div>
							<button class="primary-btn add-to-cart"
								id="add_to_cart_<?=$model->id ?>" data-id='<?=$model->id ?>'
								data-amount="<?=$model->getDiscountPrice()?>">
								<i class="fa fa-shopping-cart"></i> 
								<span class="mar-left-5"> Add to Cart </span>
							</button>
							<div class="pull-right">
								<?=$wishlist->add_to_wishlist($model)?>


								
<!-- 							<div data-network="sharethis" class="main-btn icon-btn"></div>  -->

								<div data-network="facebook" class="st-custom-button">
									<i class="fa fa-facebook"></i></div>
									<div data-network="twitter" class="st-custom-button">
									<i class="fa fa-twitter"></i></div>
									<div data-network="pinterest" class="st-custom-button">
									<i class="fa fa-pinterest"></i></div>
									<div data-network="googleplus" class="st-custom-button">
									<i class="fa fa-google"></i>
									
									
									
									
								</div>
								<!-- 								<button class="main-btn icon-btn"> -->
								<!-- 									<i class="fa fa-share-alt"></i> -->
								<!-- 								</button> -->
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-12">
					<div class="product-tab">
						<ul class="tab-nav">
							<li class="active"><a data-toggle="tab" href="#tab1">Description</a></li>
							<li><a data-toggle="tab" href="#tab1">Details</a></li>
							<li><a data-toggle="tab" href="#tab2">Reviews (<?=count($reviewDataProvider->models) ?>)</a></li>
						</ul>
						<div class="tab-content">
							<div id="tab1" class="tab-pane fade in active">
								<p><?= !empty($model->description)?$model->description:'Not Available'?></p>
							</div>
							<div id="tab2" class="tab-pane fade in">

								<div class="row">
									<div class="col-md-6">
										<div class="product-reviews">
											<?=\Yii::$app->controller->renderPartial('/review/_reviewList',['dataProvider'=>$reviewDataProvider])?>
											<!-- <!-- <ul class="reviews-pages">
<!-- 												<li class="active">1</li> -->
											<!-- 												<li><a href="#">2</a></li> -->
											<!-- 												<li><a href="#">3</a></li> -->
											<!-- 												<li><a href="#"><i class="fa fa-caret-right"></i></a></li> -->
										</div>
									</div>
									<div class="col-md-6">
										<h4 class="text-uppercase">Write Your Review</h4>
										<p>Your email address will not be published.</p>
										
										
										    <?php
    
    $form = ActiveForm::begin([
        'action' => [
            'review/add',
            'id' => $model->id
        ],
        'options' => [
            'tage' => false,
            'class' => 'review-form'
        ]
    
    ]);
    ?>
										
											<div class="form-group">
												
												    <?= $form->field($review, 'name')->textInput(['placeholder'=>'Your Name']) ?>
												
											</div>
										<div class="form-group">
										<?= $form->field($review, 'email')->textInput(['placeholder'=>'Email']) ?>

											</div>
										<div class="form-group">
											<?= $form->field($review, 'comments')->textarea(['placeholder'=>'review','row'=>4]) ?>
												
											</div>
										<div class="form-group">
											<div class="input-rating">
												<strong class="text-uppercase">Your Rating: </strong>
												<div class="stars">
													<input type="radio" id="star5" name="Review[ratings]"
														value="5" /><label for="star5"></label> <input
														type="radio" id="star4" name="Review[ratings]" value="4" /><label
														for="star4"></label> <input type="radio" id="star3"
														name="Review[ratings]" value="3" /><label for="star3"></label>
													<input type="radio" id="star2" name="Review[ratings]"
														value="2" /><label for="star2"></label> <input
														type="radio" id="star1" name="Review[ratings]" value="1" /><label
														for="star1"></label>
												</div>
											</div>
										</div>
										<button class="primary-btn">Submit</button>
										<?php ActiveForm::end();?>
									</div>
								</div>



							</div>
						</div>
					</div>
				</div>

			</div>
			<!-- /Product Details -->
		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</div>


<?php }?>
<!-- /section -->

<!-- section -->
<div class="section">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row">
			<!-- section title -->
			<div class="col-md-12">
				<div class="section-title">
					<h2 class="title">Picked For You</h2>
				</div>
			</div>
			<!-- section title -->

			<!-- Product Single -->
			<?php
echo Yii::$app->controller->renderPartial('/site/picked-out', [
    'dataProvider' => $dataProvider
]);
// echo $this->render("picked-out",['dataProvider'=>$dataProvider]);//declare it 'content' since $content is inside the main.php
?>
			
			<!-- /Product Single -->
		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</div>
<!-- /section -->

<script>
//initiate the plugin and pass the id of the div containing gallery images
$("#img_01").elevateZoom({gallery:'product-main-view', cursor: 'pointer', galleryActiveClass: 'active', imageCrossfade: true, loadingIcon: 'http://www.elevateweb.co.uk/spinner.gif'}); 

//pass the images to Fancybox
$("#img_01").bind("click", function(e) {  
  	var ez =   $('#img_01').data('elevateZoom');	
	$.fancybox(ez.getGalleryList());
  	return false;
});

</script>
<?php
use app\models\Product;
use yii\helpers\HtmlPurifier;
use yii\helpers\Url;
?>
<?php

$bannerList = (new Product())->getBannerList();

if (! empty($bannerList)) {
    ?>

<!-- home wrap -->
<div class="home-wrap">
	<!-- home slick -->
	<div id="home-slick">
		<!-- banner -->
		
		<?php
    
    foreach ($bannerList as $deal) {
        ?>
		<div class="banner banner-1">
			<a href="<?=Url::toRoute(['product/list', 'banner'=>$deal->slug]) ?>" style="width:100%">
				<?= $deal->getImageFile($deal, $default = 'banner01.jpg', $options = ['class'=>'banner-image__Main']);?>
			</a>
			<div class="banner-caption text-center">
				<h1><?=$deal->title?></h1>
				<h3 class="white-color font-weak">
                          <?= HtmlPurifier::process($deal->description); ?></h3>
			</div>
		</div>

		<!-- /banner -->
				
		<?php }?>
		
	</div>
	<!-- /home slick -->
</div>

<?php } ?>
<!-- /HOME -->

<!-- section -->
<!-- <div class="section"> -->
<!-- container -->
<!-- row -->
<!-- 		<div class="row"> -->
<!-- banner -->
<!-- 			<div class="col-md-4 col-sm-6"> -->
<!-- 				<a class="banner banner-1" href="#"> <img -->
<!-- 					src= -->
<?php  //\Yii::$app->view->theme->getUrl('/frontend') ?>
<!-- 					/img/banner10.jpg" -->
<!-- 					alt=""> -->
<!-- 					<div class="banner-caption text-center"> -->
<!-- 						<h2 class="white-color">NEW COLLECTION</h2> -->
<!-- 					</div> -->
<!-- 				</a> -->
<!-- 			</div> -->
<!-- /banner -->

<!-- banner -->
<!-- 			<div class="col-md-4 col-sm-6"> -->
<!-- 				<a class="banner banner-1" href="#"> <img -->
<!-- 					src= -->
<?php //\Yii::$app->view->theme->getUrl('/frontend') ?>
<!-- 					/img/banner11.jpg" -->
<!-- 					alt=""> -->
<!-- 					<div class="banner-caption text-center"> -->
<!-- 						<h2 class="white-color">NEW COLLECTION</h2> -->
<!-- 					</div> -->
<!-- 				</a> -->
<!-- 			</div> -->
<!-- /banner -->

<!-- banner -->
<!-- 			<div class="col-md-4 col-md-offset-0 col-sm-6 col-sm-offset-3"> -->
<!-- 				<a class="banner banner-1" href="#"> <img -->
<!-- 					src= -->
<?php // \Yii::$app->view->theme->getUrl('/frontend') ?>
<!-- 					/img/banner12.jpg" -->
<!-- 					alt=""> -->
<!-- 					<div class="banner-caption text-center"> -->
<!-- 						<h2 class="white-color">NEW COLLECTION</h2> -->
<!-- 					</div> -->
<!-- 				</a> -->
<!-- 			</div> -->
<!-- /banner -->
<!-- /row -->
<!-- 	</div> -->
<!-- /container -->
<!-- </div> -->
<!-- /section -->

<!-- section -->
<div class="section">
	<!-- container -->
	<!-- row -->
<?= \Yii::$app->controller->renderPartial('_deal',['dealDataProvider'=>$dealDataProvider])?>
			<!-- /Product Slick -->
	<!-- /row -->

	<!-- row -->
	<!-- /row -->
</div>
<!-- /container -->
<!-- /section -->

<!-- section -->
<!-- /section -->

<!-- section -->
<div class="section">
	<!-- row -->
	<div class="row">
		<!-- section title -->
		<div class="col-md-12">
			<div class="section-title">
				<h2 class="title">Latest Products</h2>
			</div>
		</div>
		<!-- section title -->

		<!-- Product Single -->
		<!-- /Product Single -->


		<!-- Product Single -->

		<!-- Product Single -->

		<!-- Product Single -->
			<?=\Yii::$app->controller->renderPartial('product_md-3',['latestDataProvider'=>$latestDataProvider]) ?>
			<!-- /Product Single -->
	</div>
	<!-- /row -->

	<!-- row -->
	<!-- /row -->

	<!-- row -->
	<div class="row">
		<!-- section title -->
		<div class="col-md-12">
			<div class="section-title">
				<h2 class="title">Picked For You</h2>
			</div>
		</div>
			
						<?=\Yii::$app->controller->renderPartial('product_md-3',['latestDataProvider'=>$latestDataProvider]) ?>
			
	<!-- /Product Single -->
	</div>
	<!-- /row -->
</div>
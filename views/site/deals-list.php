<?php
use yii\helpers\Url;
use app\models\Product;
use app\models\Deal;
use yii\helpers\HtmlPurifier;

$products = Product::find ()->where ( [ 
		'deal_id' => $model->id 
] )->limit ( 6 )->all ();

?>

<?php if(!empty($products)) {?>
<div class="row">
	<!-- section-title -->
	<div class="col-md-12">
		<div class="section-title">
			<h2 class="title"><?=$model->title ?></h2>

		</div>
	</div>
	<!-- /section-title -->

	<!-- banner -->
	<div class="col-md-3 col-sm-6 col-xs-6">
		<div class="banner banner-2 height-banner">
				<?=  $model->getImageFile($model, $default = 'banner01.jpg');?>
					
					<div class="banner-caption">
				<h2 class="white-color">
							<?= $model->title?>
						</h2>
				<a class="btn btn-primary"
					href="<?=Url::toRoute(['product/list','deal'=>$model->slug]) ?>"><?=\yii::t('app','Shop Now') ?></a>
			</div>
		</div>
	</div>
	<!-- /banner -->

	<!-- Product Slick -->
	<div class="col-md-9 col-sm-6 col-xs-6">
		<div class="row">
				
				<?php
	foreach ( $products as $product ) {
		?>
				
				
				<?= \Yii::$app->controller->renderPartial('_deal-product',['product'=>$product])?>
<?php }?>
						<!-- Product Single -->


			<!-- /Product Single -->
			<!-- Product Single -->


			<!-- /Product Single -->
			<!-- Product Single -->

		</div>
		
		</div>
</div>
		<?php
	
	if ($index == 0) {
		?>	
		
		
		<?php
		$deal_banners = Deal::find ()->limit ( 3 )->all ();
		?>	
		
<div class="section">
	<!-- row -->
	<div class="row">
		<!-- banner -->
		
		<?php foreach ($deal_banners as $key => $banner){?>
		
		<?php if($key==0){?>
		<div class="col-md-8">
			<div class="banner banner-1">
				
									   <?=  $banner->getImageFile($banner, $default = 'banner01.jpg');?>
					
				<div class="banner-caption text-center">
				<h1><?=$banner->title?></h1>
				<h3 class="white-color font-weak">
                          <?= HtmlPurifier::process($banner->description); ?></h3>
				<a class="btn btn-primary"
					href="<?=Url::toRoute(['product/list','deal'=>$banner->slug]) ?>"><?=\yii::t('app','Shop Now') ?></a>
			</div>
			</div>
		</div>
		<?php }else{?>
		<!-- /banner -->

		<!-- banner -->
		<div class="col-md-4 col-sm-6">
			<a class="banner banner-1" href="<?=Url::toRoute(['product/list','deal'=>$banner->slug]) ?>">									   <?=  $banner->getImageFile($banner, $default = 'banner01.jpg');?>

				<div class="banner-caption text-center">
					<h2 class="white-color"><?=$banner->title ?></h2>
				</div>
			</a>
		</div>
		<?php }}?>
		<!-- /banner -->

		<!-- banner -->
		
		<!-- /banner -->
	</div>
	<!-- /row -->
</div>

<?php }?>
		
		
		<?php }?>
		

		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
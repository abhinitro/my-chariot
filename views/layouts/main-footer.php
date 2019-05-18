<?php
use yii\helpers\Url;
use app\models\Page;
?>
<hr>
<footer id="footer" class="section section-white">
	<div class="container">
		<div class="row">
			<div class="col-md-3">
				<div class="widget-ft widget-about">
					<div class="logo logo-ft">
						<a href="index.html" title=""> <img src="images/logos/logo-ft.png"
							alt="">
						</a>
					</div>
					<!-- /.logo-ft -->
					<div class="widget-content">
						<div class="widget-title">
							<h3><?= \Yii::$app->name ?></h3>
						</div>
						<div class="info">
							<p class="questions">Got Questions ? Call us 24/7!</p>
							<p class="phone">Call Us: (888) 1234 56789</p>
							<p class="address">PO Box CT16122 Collins Street West, Victoria
								8007,Canada.</p>
						</div>
					</div>
					<!-- /.widget-content -->
					<ul class="social-list">
						<li><a href="#" title=""> <i class="fa fa-facebook"
								aria-hidden="true"></i>
						</a></li>
						<li><a href="#" title=""> <i class="fa fa-twitter"
								aria-hidden="true"></i>
						</a></li>
						<li><a href="#" title=""> <i class="fa fa-instagram"
								aria-hidden="true"></i>
						</a></li>
					</ul>
					<!-- /.social-list -->
				</div>
				<!-- /.widget-about -->
			</div>
			<!-- /.col-lg-3 col-md-6 -->
			<div class="col-md-2">
				<div class="widget-ft widget-categories-ft">
					<div class="widget-title">
						<h3><?=\yii::t('app','Find By Categories')?></h3>
					</div>
					<?php
    $model = new \app\models\Category();
    
    $categories = $model->getCategoryLIst($limit = 8);
    if (! empty($categories)) {
        ?>
					<ul class="cat-list-ft">
				<?php foreach ($categories as $category){?>
						<li><a
							href="<?=Url::toRoute(['/product/list','category'=>$category->slug]) ?>"
							title="<?=$category->title?>"><?=$category->title ?></a></li>
						<?php }?>
					</ul>
					<?php }?>
					<!-- /.cat-list-ft -->
				</div>
				<!-- /.widget-categories-ft -->
			</div>
			<!-- /.col-lg-3 col-md-6 -->
			<div class="col-md-2">
				<div class="widget-ft widget-menu">
					<div class="widget-title">
						<h3>Company Info.</h3>
					</div>
					<ul>
						<li><a href="<?=Url::toRoute(['/site/contact']) ?>"
							title="<?=\yii::t('app','Contact us')?>"> <?=\yii::t('app','Contact us')?> </a></li>
						<li><a href="#" title=""> Site Map </a></li>
						<li><a
							href="<?= (\Yii::$app->user->id)?Url::toRoute(['user/profile']):Url::toRoute(['user/login']) ?>"
							title=""> My Account </a></li>
						<!-- 						<li><a href="#" title=""> Wish List </a></li> -->
						<li><a href="<?= Url::toRoute(['site/about'])?>" title=""> About
								us </a></li>

						<li><a href="<?=Url::toRoute(['site/privacy-policy'])?>" title="">
								Privacy Policy </a></li>
						<li><a href="<?= Url::toRoute(['site/term-condition'])?>" title="">
								Terms &amp; Conditions </a></li>
					</ul>
				</div>
				<!-- /.widget-menu -->
			</div>
			<div class="col-md-2">
				<div class="widget-ft widget-menu">
					<div class="widget-title">
						<h3>Services & Support</h3>
					</div>
					<ul>
						<?php
    $pages = Page::find()->where([
        'state_id' => Page::STATE_ACTIVE
    ])
        ->andWhere([
        'not in',
        'type_id',
        array_keys(Page::gettypeOption())
    ])
        ->all();
    
    if (! empty($pages)) {
        foreach ($pages as $page) {
            ?>
                <li><a
							href="<?= Url::toRoute(['site/support', 'slug' => $page->slug])?>"
							title="<?= $page->title ?>">
								<?= $page->title ?> </a></li>
           <?php
        }
    }
    ?>
					</ul>
				</div>
				<!-- /.widget-menu -->
			</div>
			<!-- /.col-lg-2 col-md-6 -->
			<div class="col-md-3">
				<div class="widget-ft widget-newsletter">
					<div class="widget-title">
						<h3>Sign Up To New Letter</h3>
					</div>
					<p>
						Make sure that you never miss our interesting <br> news by joining
						our newsletter program
					</p>
					<form action="#" class="subscribe-form" method="get"
						accept-charset="utf-8">
						<div class="subscribe-content">
							<input type="text" name="email"
								placeholder="Enter your email here.." class="subscribe-email">
							<button type="submit">
								<i class="fa fa-arrow-right"></i>
							</button>
						</div>
					</form>
				</div>
				<!-- /.widget-newsletter -->
			</div>
			<!-- /.col-lg-4 col-md-6 -->
		</div>

		<!-- /.row -->
	</div>
	<!-- /.container -->
</footer>
<section class="footer-bottom">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<p class="copyright">All Rights Reserved © <?= \Yii::$app->name ?> <?= date('Y') ?></p>

			</div>
			<!-- /.col-md-12 -->
		</div>
		<!-- /.row -->
	</div>
	<!-- /.container -->
</section>

<script type="text/javascript">
// $("#search_product_button").on("click", function () {
// 	var val = $("#search_product").val();
// 	alert(val);
// 	$.ajax({
// 		url : "< ?= Url::toRoute(['product/list']) ?>?title="+val,
// 		type: "GET",
// 		success : function (response) {}
// 	});
// });
</script>

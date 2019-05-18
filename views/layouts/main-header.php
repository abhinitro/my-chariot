<?php
use yii\helpers\Url;
use yii\helpers\Html;
use app\models\SubCategory;

?>
<header>
	<!-- top Header -->
	<div id="top-header">
		<div class="container">
			<div class="pull-left">
				<ul class="top-logos">
					<li><a href="https://www.google.com/"> <img
							src="<?= \Yii::$app->view->theme->getUrl('/frontend/img/') ?>Googlelogo.png">
					</a></li>
					<li><a href="https://www.bing.com/"><img
							src="<?= \Yii::$app->view->theme->getUrl('/frontend/img/Bing_logo.png') ?>"></a></li>
				</ul>
			</div>
			<div class="pull-right">
				<ul class="header-top-links">
					<li><a href="<?= Url::toRoute(['/site/contact']) ?>"><?=\yii::t('app','Contact Us')?></a></li>
					<li><a href="<?= Url::toRoute(['/site/faq']) ?>"><?=\yii::t('app','FAQ')?></a></li>
					<!-- <li class="dropdown default-dropdown"><a class="dropdown-toggle"
							data-toggle="dropdown" aria-expanded="true">ENG <i
								class="fa fa-caret-down"></i></a>
							<ul class="custom-menu">
								<li><a href="#">English (ENG)</a></li>
							</ul></li>
						<li class="dropdown default-dropdown"><a class="dropdown-toggle"
							data-toggle="dropdown" aria-expanded="true">USD <i
								class="fa fa-caret-down"></i></a>
							<ul class="custom-menu">
								<li><a href="#">USD ($)</a></li>
							</ul></li> -->
				</ul>
			</div>
		</div>
	</div>
	<!-- /top Header -->
	<!-- header -->
	<div id="header">
		<div class="container">
			<div class="row">
				<div class="col-md-3">
					<div class="header-logo">
						<a class="logo" href="<?= Url::home() ?>">
							<h1>
								My <span>Chariot</span>
							</h1>
						</a>
					</div>
				</div>
				<div class="col-md-6">
					<div class="header-search">
						<form method="get" action="<?= Url::toRoute(['product/list']) ?>">
							<div class="col-md-9">
								<input class="input search-input" type="text"
									placeholder="Enter your keyword" name="title"
									value="<?= isset($_GET['title']) ? $_GET['title'] : '' ?>"
									id="search_product">
							</div>
							<div class="col-md-3">
								<button class="search-btn" type="submit">
									<i class="fa fa-search"><span class="main-search-button"><?= \Yii::t('app', 'Search') ?></span></i>
								</button>
							</div>
						</form>
					</div>
				</div>
				<div class="col-md-3">
					<ul class="header-btns">
						<!-- Account -->
						<li class="header-account dropdown default-dropdown">
							<div class="dropdown-toggle" role="button" data-toggle="dropdown"
								aria-expanded="true">
								<div class="header-btns-icon">
									<i class="fa fa-user-o"></i>
								</div>
							</div>
							<ul class="custom-menu">
								<?php if( \Yii::$app->user->isGuest ) { ?>
								<li><a href="<?= Url::toRoute(['user/login']) ?>"> <i
										class="fa fa-unlock-alt"></i>Login
								</a></li>
								<li><a href="<?= Url::toRoute(['user/login']) ?>"> <i
										class="fa fa-unlock-alt"></i>Register
								</a></li>
								<?php } else { ?>
									<li><a
									href="<?= Url::toRoute(['user/profile','id'=>\Yii::$app->user->id]) ?>"><i
										class="fa fa-user-o"></i> My Account</a></li>
								<li><a href="<?= Url::toRoute(['user/wishlist']) ?>"><i
										class="fa fa-heart-o"></i> My Wishlist</a></li>
								<li><a href="<?= Url::toRoute(['order/checkout']) ?>"><i
										class="fa fa-check"></i> Checkout</a></li>
								<li>
                                        <?=Html::a('<i
                                                    class="fa fa-sign-out"></i>Sign out', ['/user/logout'], ['data-method' => 'post'])?>



                                    </li>
								<?php } ?>
							</ul>
						</li>
						<!-- /Account -->

						<!-- Cart -->
						
						<?=\Yii::$app->controller->renderPartial('/cart/_cart');?>
						
						
												<!-- /Cart -->

						<!-- Mobile nav toggle-->
						<li class="nav-toggle">
							<button class="nav-toggle-btn main-btn icon-btn">
								<i class="fa fa-bars"></i>
							</button>
						</li>
						<!-- / Mobile nav toggle -->
					</ul>
				</div>
			</div>
		</div>
		<!-- header -->
	</div>
	<!-- container -->
</header>

<!-- container -->
<div class="container">
	<div id="navigation">
		<div id="responsive-nav">
			<!-- menu nav -->
			<div class="menu-nav">
				<span class="menu-header">Menu <i class="fa fa-bars"></i></span>
				<ul class="menu-list nav-justified">
				
				
                      <?php foreach ($categories as $cat){?>
                      
                      
						<?php
                        $models = SubCategory::findAll([
                            'category_id' => $cat->id,
                            'sub_category_id' => 0
                        ]);
                        
                        ?>
																							
	<?php if(empty(!$models)){?>
																							
					<li class="dropdown"><a href="#" class="dropdown-toggle"
						data-toggle="dropdown">
						<?=$cat->title;?> <span class="caret"></span>
					</a>




						<ul class="dropdown-menu">
	<?php foreach ($models as $model){?>
							<li><a
								href="<?=Url::toRoute(['/product/list','category'=>$cat->slug,'subCategory'=>$model->slug])?>"><?=$model->title?></a></li>
							<?php }?>
							
							
						</ul>
						
						<?php }else{?>
						
						
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					<li class="dropdown"><a
						href="<?=Url::toRoute(['/product/list','category'=>$cat->slug])?>"
						class="dropdown-toggle">
						<?=$cat->title;?></a> 
						<?php }?>
						
						</li>
						
						<?php }?>

									</ul>
			</div>
			<!-- menu nav -->
		</div>
	</div>
	<!-- /container -->
</div>

<div class="container">
	<ul class="header-icon inline">
		<li class="header-icon01"><a
			href="<?= Url::toRoute(['/site/about']) ?>" target="_blank"
			rel="nofollow"> <img
				src="<?= \Yii::$app->view->theme->getUrl('frontend/img/header-icon01.png') ?>">
		</a> <a href="<?= Url::toRoute(['/site/about']) ?>" target="_blank"
			rel="nofollow"> <strong>Proudly Indian</strong>
		</a></li>
		<li class="header-icon02"><a
			href="<?= Url::toRoute(['/site/return-refund']) ?>" target="_blank"
			rel="nofollow"> <img
				src="<?= \Yii::$app->view->theme->getUrl('frontend/img/header-icon02.png') ?>">
		</a> <a href="<?= Url::toRoute(['/site/return-refund']) ?>"
			target="_blank" rel="nofollow"> <strong>Free Return</strong>
		</a></li>
		<li class="header-icon03"><a
			href="<?= Url::toRoute(['/site/shipping']) ?>" target="_blank"
			rel="nofollow"> <img
				src="<?= \Yii::$app->view->theme->getUrl('frontend/img/header-icon03.png') ?>">
		</a> <a href="<?= Url::toRoute(['/site/shipping']) ?>" target="_blank"
			rel="nofollow"> <strong>Fast shipping</strong>
		</a></li>
		<li class="header-icon04"><a
			href="<?= Url::toRoute(['/site/guarantee']) ?>" target="_blank"
			rel="nofollow"> <img
				src="<?= \Yii::$app->view->theme->getUrl('frontend/img/header-icon04.png') ?>">
		</a> <a href="<?= Url::toRoute(['/site/guarantee']) ?>"
			target="_blank" rel="nofollow"> <strong>365 Day Guarantee</strong>
		</a></li>
		<li class="header-icon05"><a
			href="<?= Url::toRoute(['/site/privacy-policy']) ?>" target="_blank"
			rel="nofollow"> <img
				src="<?= \Yii::$app->view->theme->getUrl('frontend/img/header-icon05.png') ?>">
		</a> <a href="<?= Url::toRoute(['/site/privacy-policy']) ?>"
			target="_blank" rel="nofollow"> <strong>Safe and Privacy</strong>
		</a></li>
	</ul>
</div>

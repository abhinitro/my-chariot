<?php
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this \yii\web\View */
/* @var $content string */
?>

<header class="main-header">

    <?= Html::a('<span class="logo-mini">APP</span><span class="logo-lg">' . Yii::$app->name . '</span>', Yii::$app->homeUrl, ['class' => 'logo']) ?>

    <nav class="navbar navbar-static-top" role="navigation">

		<a href="#" class="sidebar-toggle" data-toggle="push-menu"
			role="button"> <span class="sr-only">Toggle navigation</span>
		</a>

		<div class="navbar-custom-menu">

			<ul class="nav navbar-nav">

				
				<li class="dropdown notifications-menu"><a href="#"
					class="dropdown-toggle" data-toggle="dropdown"> <i
						class="fa fa-bell-o"></i> <span class="label label-warning">0</span>
				</a>
					<ul class="dropdown-menu">
						<li class="header">You have 0 notifications</li>
						
						<li class="footer"><a href="#">View all</a></li>
					</ul></li>
				
				<!-- User Account: style can be found in dropdown.less -->

				<li class="dropdown user user-menu"><a href="#"
					class="dropdown-toggle" data-toggle="dropdown"> <?=\Yii::$app->user->identity->profileImage ( [ "class" => "user-image","alt" => "User Image" ] )?> <span
						class="hidden-xs"><?=\yii::$app->user->identity->full_name?></span>
				</a>
					<ul class="dropdown-menu">
						<!-- User image -->
						<li class="user-header">
                            <?=\Yii::$app->user->identity->profileImage ( [ "class" => "img-circle","alt" => "User Image" ] )?>

                            <p>
								<?=\yii::$app->user->identity->full_name?> <small>Member since
									<?= \yii::$app->formatter->asRelativeTime(\yii::$app->user->identity->created_on) ?></small>
							</p>
						</li>
						<!-- Menu Footer-->
						<li class="user-footer">
							<div class="pull-left">
								<a href="<?= Url::toRoute(['/user/view', 'id' => \Yii::$app->user->id]) ?>" class="btn btn-default btn-flat">Profile</a>
							</div>
							<div class="pull-right">
                                <?=Html::a ( 'Sign out', [ '/user/logout' ], [ 'data-method' => 'post','class' => 'btn btn-default btn-flat' ] )?>
                            </div>
						</li>
					</ul></li>




				<!-- User Account: style can be found in dropdown.less -->
				<li><a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
				</li>
			</ul>
		</div>
	</nav>
</header>

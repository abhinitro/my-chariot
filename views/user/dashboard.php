<?php
use app\models\User;
use yii\helpers\Url;
use app\models\Order;

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */
$this->title = Yii::t ( 'app', 'Dashboard' );
$this->params ['breadcrumbs'] [] = $this->title;
?>

<div id="wrapper">

	<div id="page-wrapper">
		<div class="panel">
			<div class="panel-body">
				<h1 class="page-header">Dashboard</h1>
			</div>
			<!-- /.col-lg-12-->
		</div>
		<!-- /.row-->
		<div class="row">
			<div class="col-lg-3 col-md-6">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-3">
								<i class="fa fa-users fa-5x"></i>
							</div>
							<div class="col-xs-9 text-right">
								<div class="huge">
									<?= User::find()->count(); ?>
								</div>
								<div>Users</div>
							</div>
						</div>
					</div>
					<a href="<?= Url::toRoute(['/user']) ?>">
						<div class="panel-footer">
							<span class="pull-left">View Details</span><span
								class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
							<div class="clearfix"></div>
						</div>
					</a>
				</div>
			</div>
			<div class="col-lg-3 col-md-6">
				<div class="panel panel-green">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-3">
								<i class="fa fa-tasks fa-5x"></i>
							</div>
							<div class="col-xs-9 text-right">
								<div class="huge"><?= Order::find()->count() ?></div>
								<div>Total Orders</div>
							</div>
						</div>
					</div>
					<a href="<?= Url::toRoute(['/order']) ?>">
						<div class="panel-footer">
							<span class="pull-left">View Details</span><span
								class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
							<div class="clearfix"></div>
						</div>
					</a>
				</div>
			</div>
			<div class="col-lg-3 col-md-6">
				<div class="panel panel-yellow">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-3">
								<i class="fa fa-shopping-cart fa-5x"></i>
							</div>
							<div class="col-xs-9 text-right">
								<div class="huge"><?= Order::find()->where(['state_id' => Order::STATE_NEW])->count() ?></div>
								<div>New Orders!</div>
							</div>
						</div>
					</div>
					<a href="#">
						<div class="panel-footer">
							<span class="pull-left">View Details</span><span
								class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
							<div class="clearfix"></div>
						</div>
					</a>
				</div>
			</div>
		</div>
	</div>
	<!-- /#page-wrapper-->
</div>
<!-- /#wrapper-->
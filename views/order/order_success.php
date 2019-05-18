<?php
use app\models\OrderItem;
use yii\helpers\Url;
?>
<style>



.table {
	margin-bottom: 0px;
}

.invoice-title h2, .invoice-title h3 {
	display: inline-block;
}

.table>tbody>tr>.no-line {
	border-top: none;
}

.table>thead>tr>.no-line {
	border-bottom: none;
}

.table>tbody>tr>.thick-line {
	border-top: 2px solid;
}

/* Customize container */

/* Responsive: Portrait tablets and up */
@media screen and (min-width: 768px) {
	/* Remove the padding we set earlier */
	.header, .marketing, .footer {
		padding-right: 0;
		padding-left: 0;
	}
	/* Space out the masthead */
	.header {
		margin-bottom: 30px;
	}
	/* Remove the bottom border on the jumbotron for visual effect */
	.jumbotron {
		border-bottom: 0;
	}
}

.panel-title {
	display: inline;
	font-weight: bold;
}

.checkbox.pull-right {
	margin: 0;
}

.pl-ziro {
	padding-left: 0px;
}

.panel {
	border: 0px solid transparent;
	background: #f1f1f1;
}

.panel-default>.panel-heading .badge {
	color: #ffffff;
	background-color: transparent;
}

.container {
	border-radius: 10px;
	margin-top: 20px;
	margin-bottom: 20px;
}

.panel-heading {
	border-bottom: 0px solid #555555 !important;
}

.panel-default>.panel-heading {
	color: #ffffff;
	background-color: #428bca;
	padding-bottom: 1px !important;
}
</style>



<div class="container">

	<div class="row marketing">

		<div class="col-lg-12">


			<hr />

			<div>
				<center>
					<h4>Success - your order is confirmed!</h4>
					<h5>Order number: #<?= $order->id?></h5>
					<hr />
			
			</div>
			</center>
		</div>

		<div class="row">
			<div class="col-xs-12">
				<div class="row">
					<div class="col-xs-6">
						<address>
							<strong>Shipping Address:</strong><br>
                        <?=$order->address?><br>
                        <?= $order->email?><br>
                        <?= $order->contact_no?><br> <br>
    					<?= $order->zip ?>, <?= $order->city?>, <?=$order->country?>
    				</address>

					</div>
					<div class="col-xs-6 text-right">
						<h1>
							<span class="glyphicon glyphicon glyphicon-cloud-download"
								aria-hidden="true"></span>
						</h1>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						<center>
							<p>
								<span class="glyphicon glyphicon glyphicon-question-sign"
									aria-hidden="true"></span> Product List
							</p>
						</center>
					</div>
					<div class="panel-body">
						<div class="table-responsive">
							<table class="table table-condensed">
								<thead>
									<tr>

										<th>Product</th>
										<th></th>
										<th class="text-center">Price</th>
										<th class="text-center">Quantity</th>
										<th class="text-right"></th>
									</tr>
								</thead>
								<tbody>
									<!-- foreach ($order->lineItems as $line) or some such thing here -->
    							<?php 
    							$models=OrderItem::findAll(['order_id'=>$order->id]);
    							
    							if(!empty($models)){
    								
    								
    							
    							?>
    							
    							
    							<tr>
    							<?php    foreach ($models as $model){
    							?>
										
	<td class="details"><a href="#"><?php echo $model->product->title?></a>
			</td>
									
	
	<td></td>
	
	<td class="total text-center"><strong class="primary-color"
		id="total-amount_<?php echo $model->id?>">$<?php echo $model->product->getDiscountPrice()*$model->quantity ?></strong></td>
		
	<td class="qty text-center"><?php echo $model->quantity?></td>
										
										
										<?php }}?>
										
										
									</tr>
									<tr>
										<td class="thick-line"></td>
										<td class="thick-line"></td>
										<td class="thick-line text-right"><strong>VAT - 12%</strong></td>
										<td class="thick-line text-right">incl.</td>
									</tr>
									<tr>
										<td class="no-line"></td>
										<td class="no-line"></td>
										<td class="no-line text-right"><strong>Shipping</strong></td>
										<td class="no-line text-right">incl.</td>
									</tr>
									<tr>
										<td class="no-line"></td>
										<td class="no-line"></td>
										<td class="no-line text-right"><strong><?= \Yii::t('app','Total')?></strong></td>
										<td class="no-line text-right">$<?= $order->amount?></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>

</div>
<!-- /container -->




























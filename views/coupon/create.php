<?php


/* @var $this yii\web\View */
/* @var $model app\models\Coupon */

$this->title = Yii::t ( 'app', 'Create Coupon' );
$this->params ['breadcrumbs'] [] = [ 
		'label' => Yii::t ( 'app', 'Coupons' ),
		'url' => [ 
				'index' 
		] 
];
$this->params ['breadcrumbs'] [] = $this->title;
?>
<div class="coupon-create">

    <?=\app\components\BasePageHeader::widget();?>
    <div class="panel">
		<div class="panel-body">

    <?=$this->render ( '_form', [ 'model' => $model ] )?>
</div>
	</div>
</div>

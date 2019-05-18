<?php


/* @var $this yii\web\View */
/* @var $model app\models\Coupon */

$this->title = Yii::t ( 'app', 'Update Coupon: {nameAttribute}', [ 
		'nameAttribute' => $model->title 
] );
$this->params ['breadcrumbs'] [] = [ 
		'label' => Yii::t ( 'app', 'Coupons' ),
		'url' => [ 
				'index' 
		] 
];
$this->params ['breadcrumbs'] [] = [ 
		'label' => $model->title,
		'url' => [ 
				'view',
				'id' => $model->id 
		] 
];
$this->params ['breadcrumbs'] [] = Yii::t ( 'app', 'Update' );
?>
<div class="coupon-update">

    <?=\app\components\BasePageHeader::widget();?>
<div class="panel">
		<div class="panel-body">
    <?=$this->render ( '_form', [ 'model' => $model ] )?>
</div>
	</div>
</div>

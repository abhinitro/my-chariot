<?php
use app\components\BasePageHeader;

/* @var $this yii\web\View */
/* @var $model app\models\Product */

$this->title = Yii::t ( 'app', 'Create Product' );
$this->params ['breadcrumbs'] [] = [ 
		'label' => Yii::t ( 'app', 'Products' ),
		'url' => [ 
				'index' 
		] 
];
$this->params ['breadcrumbs'] [] = $this->title;
?>
<div class="product-create">

      <?= BasePageHeader::widget() ?>
<div class="panel">
		<div class="panel-body">

    <?=$this->render ( '_form', [ 'model' => $model,'media' => $media,'productPrice' => $productPrice ] )?>

</div>
	</div>
</div>

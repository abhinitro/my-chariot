<?php


use app\components\BasePageHeader;

/* @var $this yii\web\View */
/* @var $model app\models\Deal */

$this->title = Yii::t ( 'app', 'Create Deal' );
$this->params ['breadcrumbs'] [] = [ 
		'label' => Yii::t ( 'app', 'Deals' ),
		'url' => [ 
				'index' 
		] 
];
$this->params ['breadcrumbs'] [] = $this->title;
?>
<div class="deal-create">

  


		 <p><?=BasePageHeader::widget();?>
	<div class="panel">
		<div class="panel-body">



    <?=$this->render ( '_form', [ 'model' => $model,'media' => $media ] )?>
</div>
	</div>
</div>

<?php
use app\components\BasePageHeader;

/* @var $this yii\web\View */
/* @var $model app\models\Deal */

$this->title = Yii::t ( 'app', 'Update Deal: {nameAttribute}', [ 
		'nameAttribute' => $model->title 
] );
$this->params ['breadcrumbs'] [] = [ 
		'label' => Yii::t ( 'app', 'Deals' ),
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
<div class="deal-update">
	<?=BasePageHeader::widget() ?>
<div class="panel">
		<div class="panel-body">

    <?=$this->render ( '_form', [ 'model' => $model,'media'=>$media ] )?>

</div>
	</div>
</div>
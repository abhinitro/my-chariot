<?php
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Coupon */

$this->title = $model->title;
$this->params ['breadcrumbs'] [] = [ 
		'label' => Yii::t ( 'app', 'Coupons' ),
		'url' => [ 
				'index' 
		] 
];
$this->params ['breadcrumbs'] [] = $this->title;
?>
<div class="coupon-view">

    <?=\app\components\BasePageHeader::widget();?>


<div class="panel">
		<div class="panel-body">
    <?=DetailView::widget ( [ 'model' => $model,'attributes' => [ 'id','title',['attribute'=>'description','value'=>strip_tags($model->description)],'code','discount','max_discount','max_use',[ 'attribute' => 'state_id','format' => 'raw','value' => function ($model) {return $model->stateBadges ();} ],'created_on',[ 'attribute' => 'create_user_id','value' => function ($model) {return $model->createUser->full_name;} ] ] ] )?>
</div>
	</div>
</div>

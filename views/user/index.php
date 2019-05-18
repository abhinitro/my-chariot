<?php
use app\components\BaseGridView;
use app\components\BasePageHeader;
use yii\base\Widget;
use yii\helpers\Html;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t ( 'app', 'Users' );
$this->params ['breadcrumbs'] [] = $this->title;
?>
<div class="user-index">

    <?php echo BasePageHeader::widget(); ?>
    <div class="panel">
		<div class="panel-body">
<?php Pjax::begin(); ?>    <?php

echo BaseGridView::widget ( [ 
		'dataProvider' => $dataProvider,
		'filterModel' => $searchModel,
		'columns' => [ 
				[ 
						'class' => 'yii\grid\CheckboxColumn' 
				],
				'id',
				'username',
				'email:email',
				'status',
				[ 
						'class' => 'app\components\BaseActionColumn',
						'template' => '{view}{update}{delete}{myButton}',
						'buttons' => [ 
								'myButton' => function ($url, $model, $key) { // render your custom button
									return Html::a ( '<i class="fa fa-key" aria-hidden="true"></i>', \yii\helpers\Url::toRoute ( [ 
											'changepassword',
											'id' => $model->id 
									] ), [ 
											'class' => 'label label-warning' 
									] );
								} 
						] 
				
				] 
		] 
] );
?>
<?php Pjax::end(); ?></div>
	</div>
</div>
<?php
use app\components\BasePageHeader;
use yii\base\Widget;
use yii\widgets\DetailView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = $model->id;
$this->params ['breadcrumbs'] [] = [ 
		'label' => Yii::t ( 'app', 'Users' ),
		'url' => [ 
				'index' 
		] 
];
$this->params ['breadcrumbs'] [] = $this->title;
$changePassword = '<a href="' . Url::toRoute ( [ 
		'/user/changepassword/',
		'id' => $model->id 
] ) . '" class="btn btn-info" title="' . \Yii::t ( 'app', 'Change Password' ) . '"><i class="fa fa-key" aria-hidden="true"></i></a>';
?>
<div class="user-view">

        <?php echo BasePageHeader::widget(['buttons' => ['Change Password' => $changePassword]]); ?>
<div class="panel">
		<div class="panel-body">
			<div class="col-md-2">
				<?= $model->profileImage() ?>
			</div>
			<div class="col-md-10">
		 <?php
			
			echo DetailView::widget ( [ 
					'model' => $model,
					'attributes' => [ 
							'id',
							'full_name',
							'username',
							'email:email',
							[ 
									'attribute' => 'state_id',
									'format' => 'raw',
									'value' => function ($model) {
										return $model->stateBadges ();
									} 
							],
							'role_id',
							'created_on',
							'updated_on' 
					] 
			] )?>
		</div>
            <?php
												
												echo \app\components\BaseUserAction::widget ( [ 
														'current_model' => $model,
														'attribute' => 'state_id',
														'states' => $model->getStateOption () 
												] );
												?>

		</div>
	</div>

</div>

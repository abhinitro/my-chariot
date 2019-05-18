<?php
use app\components\BasePageHeader;
use yii\helpers\HtmlPurifier;
use yii\widgets\DetailView;
use app\modules\media\models\Media;
use yii\data\ActiveDataProvider;
use app\models\Keyword;

/* @var $this yii\web\View */
/* @var $model app\models\Category */

$this->title = $model->title;
$this->params ['breadcrumbs'] [] = [ 
		'label' => Yii::t ( 'app', 'Categories' ),
		'url' => [ 
				'index' 
		] 
];
$this->params ['breadcrumbs'] [] = $this->title;
?>
<div class="category-view">

	<h1><?=BasePageHeader::widget() ?></h1>
	<div class="panel">
		<div class="panel-body">



			<div class="row">
				<div class="col-md-3">

  <?=$model->getImageFile($model,$default = 'user.png', $options = [],$attribute='file_name');?>
  
 </div>
				<div class="col-md-9">
   
     <?php
					
					echo DetailView::widget ( [ 
							'model' => $model,
							'attributes' => [ 
									'id',
									'title',
									[ 
											'attribute' => 'state_id',
											'format' => 'raw',
											'value' => function ($model) {
												return $model->getStateBadges ();
											} 
									],
									'updated_on',
									'created_on',
									[ 
											'attribute' => 'create_user_id',
											'format' => 'raw',
											'value' => function ($model) {
												return $model->getCreatedUser ();
											} 
									] 
							] 
					] )?>
					
					<?= HtmlPurifier::process($model->description); ?>
   </div>

			</div>

		</div>

		<div class="panel-body">
			<h4><?= Yii::t('app', 'Keywords') ?></h4>
		<?php
		$keywords = Keyword::find ()->where ( [ 
				'model_id' => $model->id,
				'model_type' => get_class ( $model ) 
		] )->all ();
		
		if (! empty ( $keywords )) {
			foreach ( $keywords as $keyword ) {
				echo "<strong class='compatibleProduct'>" . $keyword->title . "</strong>&nbsp&nbsp&nbsp";
			}
		}
		?>
			</div>

	</div>

	<div class="panel">
		<div class="panel-body">
			<h4><?= Yii::t('app', 'Category Images') ?></h4>
		<?php
		$query = Media::find ()->where ( [ 
				'model_id' => $model->id,
				'model_type' => get_class ( $model ) 
		] );
		
		$dataProvider = new ActiveDataProvider ( [ 
				'query' => $query 
		] );
		
		echo $this->render ( '@app/modules/media/views/default/index', [ 
				'dataProvider' => $dataProvider 
		] );
		?>

 </div>

	</div>

</div>
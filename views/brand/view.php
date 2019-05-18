<?php
use app\components\BasePageHeader;
use yii\base\Widget;
use yii\helpers\HtmlPurifier;
use yii\widgets\DetailView;
use app\models\Keyword;
use app\modules\media\models\Media;
use yii\data\ActiveDataProvider;

/* @var $this yii\web\View */
/* @var $model app\models\Brand */

$this->title = $model->title;
$this->params ['breadcrumbs'] [] = [ 
		'label' => Yii::t ( 'app', 'Brands' ),
		'url' => [ 
				'index' 
		] 
];
$this->params ['breadcrumbs'] [] = $this->title;
?>
<div class="brand-view">

	<?= BasePageHeader::widget() ?>

<div class="panel">
		<div class="panel-body">
			<div class="row">
				<div class="col-md-3">
 
  <?=$model->getImageFile($model,$default = 'user.png', $options = [],$attribute='thumb_file');?>
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
								'created_on',
								'updated_on',
								[ 
										'attribute' => 'create_user_id',
										'format' => 'raw',
										'value' => function ($model) {
											return $model->getCreatedUser ();
										} 
								] 
						] 
				] )?>
   

</div>
<?php echo HtmlPurifier::process($model->description); ?>
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

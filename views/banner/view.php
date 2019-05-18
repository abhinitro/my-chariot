<?php
use app\components\BasePageHeader;
use yii\widgets\DetailView;
use app\modules\media\models\Media;
use yii\data\ActiveDataProvider;
use yii\helpers\HtmlPurifier;

/* @var $this yii\web\View */
/* @var $model app\models\Banner */

$this->title = $model->title;
$this->params['breadcrumbs'][] = [
    'label' => Yii::t('app', 'Banners'),
    'url' => [
        'index'
    ]
];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="banner-view">

    <?= BasePageHeader::widget() ?>

<div class="panel">
		<div class="panel-body">
			<div class="row">
				<div class="col-md-3">
 
  <?=$model->getImageFile($model,$default = 'user.png', $options = [],$attribute='thumb_file');?>
 </div>

				<div class="col-md-9">

    <?php
    
    echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            [
                'attribute' => 'state_id',
                'format' => 'raw',
                'value' => function ($model) {
                    return $model->getStateBadges();
                }
            ],
            'created_on',
            'updated_on',
            [
                'attribute' => 'create_user_id',
                'format' => 'raw',
                'value' => function ($model) {
                    return $model->getCreatedUser();
                }
            ]
        ]
    ])?>
</div>
<?php echo HtmlPurifier::process($model->description); ?>
			</div>
		</div>
	</div>

	<div class="panel">
		<div class="panel-body">
			<h4><?= Yii::t('app', 'Banner Images') ?></h4>
		<?php
$query = Media::find()->where([
    'model_id' => $model->id,
    'model_type' => get_class($model)
]);

$dataProvider = new ActiveDataProvider([
    'query' => $query
]);

echo $this->render('@app/modules/media/views/default/index', [
    'dataProvider' => $dataProvider
]);
?>

 </div>

	</div>
</div>

<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
use app\components\BasePageHeader;
use yii\helpers\HtmlPurifier;

/* @var $this yii\web\View */
/* @var $model app\models\Deal */

$this->title = $model->title;
$this->params['breadcrumbs'][] = [
    'label' => Yii::t('app', 'Deals'),
    'url' => [
        'index'
    ]
];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="deal-view">

	<?=BasePageHeader::widget() ?>
<div class="panel">
		<div class="panel-body">

			<div class="row">
				<div class="col-md-3">

  <?=$model->getImageFile($model,$default = 'user.png', $options = [],$attribute='file_name');?>
  
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


			</div>
		

    

<?= HtmlPurifier::process($model->description); ?>
</div>
	</div>
</div>

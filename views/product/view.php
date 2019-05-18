<?php
use app\components\BasePageHeader;
use app\models\Product;
use app\models\ProductPrice;
use app\modules\media\models\Media;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use yii\helpers\Url;
use yii\widgets\DetailView;
use app\models\Keyword;

/* @var $this yii\web\View */
/* @var $model app\models\Product */

$this->title = $model->title;
$this->params['breadcrumbs'][] = [
    'label' => Yii::t('app', 'Products'),
    'url' => [
        'index'
    ]
];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-view" ng-controller="ProductViewController">

<?=BasePageHeader::widget() ?>
<div class="panel">
		<div class="panel-body">

			<div class="row">
				<div class="col-md-3">
  <?=$model->getImageFile($model, 'product.jpg', [], 'image_file',$model->title);?>
 </div>
				<div class="col-md-9">
   
    <?php
    
    echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            [
                'attribute' => 'category_id',
                'format' => 'raw',
                'value' => function ($model) {
                    return $model->getParentTitle('category', 'category');
                }
            ],
            [
                'attribute' => 'sub_category_id',
                'format' => 'raw',
                'value' => function ($model) {
                    return $model->getParentTitle('subCategory', 'sub-category');
                }
            ],
            [
                'attribute' => 'brand_id',
                'format' => 'raw',
                'value' => function ($model) {
                    return $model->getParentTitle('brand', 'brand');
                }
            ],
            [
                'attribute' => 'deal_id',
                'format' => 'raw',
                'value' => function ($model) {
                    return $model->getParentTitle('deal', 'deal');
                }
            ],
            [
                'attribute' => 'banner_id',
                'format' => 'raw',
                'value' => function ($model) {
                    return $model->getParentTitle('banner', 'banner');
                }
            ],
            'part_number',
            'amount',
            'discount',
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
				
				<?= HtmlPurifier::process($model->description); ?>

</div>

<?php

echo \app\components\BaseUserAction::widget([
    'current_model' => $model,
    'attribute' => 'state_id',
    'states' => $model->getStateOptions()
]);
?>

			</div>
		</div>

		<div class="panel-body">
			<h4><?= Yii::t('app', 'Keywords') ?></h4>
		<?php
$keywords = Keyword::find()->where([
    'model_id' => $model->id,
    'model_type' => get_class($model)
])->all();

if (! empty($keywords)) {
    foreach ($keywords as $keyword) {
        echo "<strong class='compatibleProduct'>" . $keyword->title . "</strong>&nbsp&nbsp&nbsp";
    }
}
?>
			</div>

	</div>


	<div class="panel">
		<div class="panel-body">
			<h4> <?= \Yii::t('app', 'Price List') ?></h4>
		<?php
$query = ProductPrice::find()->where([
    'product_id' => $model->id
]);

$dataProvider = new ActiveDataProvider([
    'query' => $query
]);
?>
		
		<?= \Yii::$app->controller->renderPartial('_price', ['dataProvider' => $dataProvider]) ?>
	</div>
	</div>

	<div class="panel">
		<div class="panel-body">
			<h4><?= \Yii::t('app', 'Compatible Product') ?></h4>
		<?php
$ids = [];

if (! empty($model->product_ids)) {
    $ids = explode(',', $model->product_ids);
}

$data = Product::find()->where([
    'in',
    'id',
    $ids
])->all();

if (! empty($data)) {
    foreach ($data as $product) {
        echo Html::a($product->title, [
            '/product/view',
            'id' => $product->id
        ], [
            'class' => 'compatibleProduct'
        ]) . "&nbsp";
    }
} else {
    echo \Yii::t('app', 'No results found');
}
?>
	</div>
	</div>

	<div class="panel">
		<div class="panel-body">
			<h4><?= Yii::t('app', 'Product Images') ?></h4>
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
 
 
 <?php if(!empty($model->youtube_link)){ ?>
 <div class="row">
			<iframe id="video" width="1000" height="400"
				src="<?=$model->youtube_link?>" frameborder="0" allowfullscreen></iframe>
		</div>
 <?php }?>
		</div>
</div>
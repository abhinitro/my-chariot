<?php
use app\components\BaseGridView;
use app\components\BasePageHeader;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t ( 'app', 'Products' );
$this->params ['breadcrumbs'] [] = $this->title;
?>
<div class="product-index">

       <?= BasePageHeader::widget() ?>
<div class="panel">
		<div class="panel-body">
		<?php Pjax::begin(['id' => 'pjax-grid-view']); ?>

    <?php
				
				echo BaseGridView::widget ( [ 
						'dataProvider' => $dataProvider,
						'filterModel' => $searchModel,
						'columns' => [ 
								[ 
										'class' => 'yii\grid\CheckboxColumn' 
								],
								'id',
								'title',
						    [
						        'attribute' => 'category_id',
						        'value' => function ($model) {
						        return  isset($model->categories)?$model->categories->title:'';
						        }
						        
						        ],
								[ 
										'attribute' => 'sub_category_id',
										'value' => function ($model) {
											return isset ( $model->subCategories ) ? $model->subCategories->title : '';
										} 
								
								],
								[ 
										'attribute' => 'brand_id',
										'value' => function ($model) {
											return isset ( $model->brands ) ? $model->brands->title : '';
										} 
								
								],
								// 'part_number',
								// 'amount',
								// 'description:ntext',
								// 'state_id',
								// 'type_id',
								// 'created_on',
								// 'updated_on',
								// 'create_user_id',
								[ 
										'class' => 'app\components\BaseActionColumn' 
								] 
						] 
				] );
				?>
				<?php Pjax::end(); ?>
</div>
	</div>
</div>

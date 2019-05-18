<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\components\BasePageHeader;
use app\components\BaseGridView;
/* @var $this yii\web\View */
/* @var $searchModel app\models\SubCategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t ( 'app', 'Sub Categories' );
$this->params ['breadcrumbs'] [] = $this->title;
?>
<div class="sub-category-index">

	<h1><?=BasePageHeader::widget() ?></h1>
	<div class="panel">
		<div class="panel-body">
    <?php Pjax::begin(['id' => 'pjax-grid-view']); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

   

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
											return isset ( $model->category ) ? $model->category->title : '';
										} 
								
								],
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
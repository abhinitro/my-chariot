<?php
use app\components\BaseGridView;
use app\components\BasePageHeader;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\DealSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t ( 'app', 'Deals' );
$this->params ['breadcrumbs'] [] = $this->title;
?>
<div class="deal-index">

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
										'class' => 'app\components\BaseActionColumn' 
								] 
						] 
				] );
				?>
    <?php Pjax::end(); ?>
</div>
	</div>
</div>

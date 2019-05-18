<?php
use \yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\OrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Orders';
$this->params ['breadcrumbs'] [] = $this->title;
?>
<div class="order-index">

	<p> <?=\app\components\BasePageHeader::widget();?>  </p>
    <?php \yii\widgets\Pjax::begin(); ?>
    <?=\app\components\BaseGridView::widget ( [ 'dataProvider' => $dataProvider,'filterModel' => $searchModel,'columns' => [ [ 'class' => 'yii\grid\CheckboxColumn' ],'id','amount','discount',[ 'class' => 'app\components\BaseActionColumn' ] ] ] );?>
    <?php Pjax::end(); ?>

</div>

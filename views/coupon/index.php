<?php
use app\components\BaseActionColumn;
use app\components\BaseGridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\CouponSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t ( 'app', 'Coupons' );
$this->params ['breadcrumbs'] [] = $this->title;
?>
<div class="coupon-index">

    <?=\app\components\BasePageHeader::widget();?>

	<div class="panel">
		<div class="panel-body">
    <?php Pjax::begin(); ?>
    <?=BaseGridView::widget ( [ 'dataProvider' => $dataProvider,'filterModel' => $searchModel,'columns' => [ 'id','title','code','discount',[ 'class' => 'app\components\BaseActionColumn' ] ] ] );?>
    <?php Pjax::end(); ?>
    </div>
	</div>
</div>

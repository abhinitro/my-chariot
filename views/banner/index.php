<?php

use app\components\BaseGridView;
use app\components\BasePageHeader;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\BannerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Banners');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="banner-index">

    <?= BasePageHeader::widget() ?>
<div class="panel">
		<div class="panel-body">
		<?php Pjax::begin(['id' => 'pjax-grid-view']); ?>
    <?= BaseGridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',

            [
                'class' => 'app\components\BaseActionColumn'
            ] 
        ],
    ]); ?>
    <?php Pjax::end(); ?>
    </div>
	</div>
</div>

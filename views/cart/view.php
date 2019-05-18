<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Cart */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Carts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cart-view">

  	<?=BasePageHeader::widget() ?>
  <div class="panel">
		<div class="panel-body">
  

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'product_id',
            'amount',
            'quantity',
            'detail:ntext',
            'url:url',
            'state_id',
            'type_id',
            'created_on',
            'updated_on',
            'cookie_id',
            'create_user_id',
        ],
    ]) ?>

</div>
</div>
</div>

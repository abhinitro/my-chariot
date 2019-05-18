<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Order */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-view">

    <p> <?=\app\components\BasePageHeader::widget();?>  </p>



    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'amount',
            'discount',
            'code',
            'vat',
            'tax',
            'full_name',
            'address',
            'latitude',
            'longitude',
            'url:url',
            'state_id',
            'type_id',
            'created_on',
            'updated_on',
            'create_user_id',
        ],
    ]) ?>

</div>

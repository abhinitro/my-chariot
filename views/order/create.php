<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Order */

$this->title = 'Create Order';
$this->params['breadcrumbs'][] = ['label' => 'Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-create">

    <p> <?=\app\components\BasePageHeader::widget();?>  </p>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

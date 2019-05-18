<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Cart */

$this->title = Yii::t('app', 'Update Cart: ' . $model->id, [
    'nameAttribute' => '' . $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Carts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="cart-update">

           <?= BasePageHeader::widget() ?>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

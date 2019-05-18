<?php

use yii\helpers\Html;
use app\components\BasePageHeader;

/* @var $this yii\web\View */
/* @var $model app\models\SubCategory */

$this->title = Yii::t('app', 'Update Sub Category: {nameAttribute}', [
    'nameAttribute' => $model->title,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Sub Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="sub-category-update">

      <h1><?=BasePageHeader::widget() ?></h1>
<div class="panel">
		<div class="panel-body">
    <?= $this->render('_form', [
        'model' => $model,
        'media'=>$media
    ]) ?>

</div>
</div>
</div>

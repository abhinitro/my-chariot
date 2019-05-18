<?php

use yii\helpers\Html;
use app\components\BasePageHeader;

/* @var $this yii\web\View */
/* @var $model app\models\Product */

$this->title = Yii::t('app', 'Update Product: {nameAttribute}', [
    'nameAttribute' => $model->title,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Products'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="product-update">

  
<?=BasePageHeader::widget() ?>
<div class="panel">
		<div class="panel-body">

    <?= $this->render('_update', [
        'model' => $model,
        'media'=>$media
    ]) ?>

</div>
</div>

</div>


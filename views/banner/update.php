<?php
use app\components\BasePageHeader;

/* @var $this yii\web\View */
/* @var $model app\models\Banner */

$this->title = Yii::t('app', 'Update Banner: {nameAttribute}', [
    'nameAttribute' => $model->title
]);
$this->params['breadcrumbs'][] = [
    'label' => Yii::t('app', 'Banners'),
    'url' => [
        'index'
    ]
];
$this->params['breadcrumbs'][] = [
    'label' => $model->title,
    'url' => [
        'view',
        'id' => $model->id
    ]
];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="brand-update">

	<h1><?= BasePageHeader::widget() ?></h1>
	<div class="panel">
		<div class="panel-body">

    <?=$this->render('_form', ['model' => $model,'media' => $media])?>

</div>
	</div>
</div>

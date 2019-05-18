<?php
use app\components\BasePageHeader;

/* @var $this yii\web\View */
/* @var $model app\models\Page */

$this->title = Yii::t('app', 'Update Page: ' . $model->title, [
    'nameAttribute' => '' . $model->title
]);
$this->params['breadcrumbs'][] = [
    'label' => Yii::t('app', 'Pages'),
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
<div class="page-update">

	<h1><?=BasePageHeader::widget() ?></h1>
	<div class="panel">
		<div class="panel-body">

    <?=$this->render('_form', ['model' => $model])?>
</div>
	</div>
</div>

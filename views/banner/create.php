<?php
use app\components\BasePageHeader;
/* @var $this yii\web\View */
/* @var $model app\models\Banner */

$this->title = Yii::t('app', 'Create Banner');
$this->params['breadcrumbs'][] = [
    'label' => Yii::t('app', 'Banners'),
    'url' => [
        'index'
    ]
];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="banner-create">

        <?=BasePageHeader::widget()?>
<div class="panel">
		<div class="panel-body">

    <?=$this->render('_form', ['model' => $model,'media' => $media])?>

</div>
	</div>
</div>
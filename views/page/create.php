<?php

use yii\helpers\Html;
use app\components\BasePageHeader;


/* @var $this yii\web\View */
/* @var $model app\models\Page */

$this->title = Yii::t('app', 'Create Page');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Pages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-create">

 <h1><?=BasePageHeader::widget() ?></h1>
<div class="panel">
		<div class="panel-body">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
</div>
</div>

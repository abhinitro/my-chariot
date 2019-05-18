<?php

use yii\helpers\Html;
use app\components\BasePageHeader;
use yii\base\Widget;


/* @var $this yii\web\View */
/* @var $model app\models\SubCategory */

$this->title = Yii::t('app', 'Create Sub Category');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Sub Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sub-category-create">

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

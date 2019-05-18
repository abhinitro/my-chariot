<?php

use app\components\BasePageHeader;


/* @var $this yii\web\View */
/* @var $model app\models\Brand */

$this->title = Yii::t('app', 'Create Brand');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Brands'), 'url' => ['index'
    ]
];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="brand-create">

    <?=BasePageHeader::widget()?>
<div class="panel">
		<div class="panel-body">


    <?= $this->render('_form', [
        'model' => $model,
        'media'=>$media
    ]) ?>

</div>
</div>
</div>

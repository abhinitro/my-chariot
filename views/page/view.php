<?php
use app\components\BasePageHeader;
use yii\widgets\DetailView;
use yii\helpers\HtmlPurifier;

/* @var $this yii\web\View */
/* @var $model app\models\Page */

$this->title = $model->title;
$this->params['breadcrumbs'][] = [
    'label' => Yii::t('app', 'Pages'),
    'url' => [
        'index'
    ]
];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-view">

    <?=BasePageHeader::widget() ?>
<div class="panel">
		<div class="panel-body">
    <?php
    
    echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            [
                'attribute' => 'state_id',
                'format' => 'raw',
                'value' => function ($model) {
                    return $model->getStateBadges();
                }
            ],
            [
                'attribute' => 'type_id',
                'format' => 'raw',
                'value' => function ($model) {
                    return $model->getType();
                }
            ],
            'created_on',
            'updated_on',
            [
                'attribute' => 'create_user_id',
                'format' => 'raw',
                'value' => function ($model) {
                    return $model->getCreatedUser();
                }
            ]
        ]
    ])?>
<?= HtmlPurifier::process($model->description); ?>
</div>
	</div>
</div>

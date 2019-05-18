<?php
use app\components\BaseGridView;
use app\components\BasePageHeader;
use yii\widgets\Pjax;
use yii\helpers\Html;
/* @var $this yii\web\View */
/* @var $searchModel app\models\PageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Pages');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-index">


	<h1><?=BasePageHeader::widget() ?></h1>
	<div class="panel">
		<div class="panel-body">
    <?php Pjax::begin(['id' => 'pjax-grid-view']); ?>

    <?php
    
    echo BaseGridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'class' => 'yii\grid\CheckboxColumn'
            ],
            'id',
            'title',
            [
                'attribute' => 'state_id',
                'format' => 'raw',
                'filter' => $searchModel->getStateOptions(),
                'value' => function ($model) {
                    return $model->getStateBadges();
                }
            ],
            [
                'class' => 'app\components\BaseActionColumn',
                'template' => '{view} {update} {delete}',
                'buttons' => [
                    'delete' => function ($url, $model) {
                        
                        $type = $model->gettypeOption();
                        
                        if (! array_key_exists($model->type_id, $type)) {
                            return Html::a(Html::tag('span', '', [
                                'class' => "rowClick glyphicon glyphicon-trash"
                            ]), [
                                'page/delete',
                                'id' => $model->id
                            ], [
                                'title' => Yii::t('yii', 'Delete'),
                                'aria-label' => Yii::t('yii', 'Delete'),
                                'data-pjax' => '0',
                                'class' => "label label-danger"
                            ]);
                        }
                    }
                ]
            ]
        ]
    ]);
    ?>
    <?php Pjax::end(); ?>
</div>
	</div>
</div>

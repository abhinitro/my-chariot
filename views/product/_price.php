<?php
use app\components\BaseGridView;
use yii\helpers\Html;
use yii\widgets\Pjax;

Pjax::begin ( [ 
		'id' => 'pjax-product-price-view' 
] );

echo BaseGridView::widget ( [ 
		'dataProvider' => $dataProvider,
		'rowClick' => false,
		'summary' => false,
		'columns' => [ 
				'min_quantity',
				'max_quantity',
				'price',
				[ 
						'class' => 'app\components\BaseActionColumn',
						'template' => "{update}{delete}",
						'buttons' => [ 
								'update' => function ($url, $model) {
									$icon = Html::tag ( 'span', '', [ 
											'class' => "glyphicon glyphicon-pencil" 
									] );
									return Html::a ( $icon, "javascript:;", [ 
											'class' => 'label label-primary' 
									] ) . "&nbsp";
								},
								'delete' => function ($url, $model) {
									$icon = Html::tag ( 'span', '', [ 
											'class' => "glyphicon glyphicon-trash" 
									] );
									return Html::a ( $icon, "javascript:;", [ 
											'class' => 'label label-danger',
											'ng-click' => "productPrice.deletePrice($model->id, 'pjax-product-price-view')" 
									] ) . "&nbsp";
								} 
						] 
				] 
		] 
] );

Pjax::end ();
?>
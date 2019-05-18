<?php
use yii\helpers\Url;
use yii\widgets\Pjax;




echo \yii\widgets\ListView::widget ( [ 
		'dataProvider' => $dataProvider,
		'summary' => '',
		'itemView' => function ($model, $key, $index, $widget) {
			return $this->render ( 'product', [ 
					'model' => $model,
					'key' => $key 
			] );
		} 
] );



?>


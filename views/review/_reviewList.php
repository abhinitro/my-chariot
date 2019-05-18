<?php
use yii\helpers\Url;
use yii\widgets\Pjax;

Pjax::begin(['enablePushState' => false]) ;


echo \yii\widgets\ListView::widget ( [
		'dataProvider' => $dataProvider,
		'summary' => '',
		'itemView' => function ($model, $key, $index, $widget) {
		return $this->render ( 'review', [
				'model' => $model,
				'key' => $key
		] );
		}
		] );

Pjax::end() ;

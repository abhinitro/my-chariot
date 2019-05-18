<?php
use yii\widgets\Pjax;


echo \yii\widgets\ListView::widget([
    'dataProvider' => $dealDataProvider,
    'summary' => '',
    'itemView' => function ($model, $key, $index, $widget) {
        return $this->render('deals-list', [
            'model' => $model,
            'key' => $key,
            'index' => $index
        ]);
    }
]);


?>
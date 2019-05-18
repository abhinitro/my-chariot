<?php
use yii\widgets\ListView;
// var_dump($dataProvider->getModels());
// exit;
echo ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => '_picked',
    'layout' => "{items}\n<div class='clearfix'></div>{pager}",
    'options' => [
        'tag' => 'table'
    ],
    'itemOptions' => [
        'tag' => false
    ]
]);
?>


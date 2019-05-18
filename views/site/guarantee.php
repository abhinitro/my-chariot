<?php
use app\models\Page;

$model = Page::find()->where([
    'type_id' => Page::TYPE_GUARANTEE,
    'state_id' => Page::STATE_ACTIVE
])->one();

if (! empty($model)) {
    echo $model->description;
} else {
    echo \Yii::t('app', 'No data found');
}
?>

<?php
use app\models\Page;

$model = Page::find()->where([
    'type_id' => Page::TYPE_ABOUT_US,
    'state_id' => Page::STATE_ACTIVE
])->one();

if (! empty($model)) {
    echo $model->description;
} else {
    echo \Yii::t('app', 'No data found');
}
?>

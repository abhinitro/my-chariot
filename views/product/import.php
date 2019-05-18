<?php
use app\components\BasePageHeader;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model app\models\Product */

$this->title = Yii::t ( 'app', 'Import Product' );
$this->params ['breadcrumbs'] [] = [ 
		'label' => Yii::t ( 'app', 'Products' ),
		'url' => [ 
				'index' 
		] 
];
$this->params ['breadcrumbs'] [] = $this->title;
?>
<div class="product-create">

      <?= BasePageHeader::widget() ?>
<div class="panel">
		<div class="panel-body">

   
    <?php $form = ActiveForm::begin(); ?>

    <?php
    echo $form->field($model, 'file_name')->fileInput()->label('Product Csv File');
   
    echo $form->field($model, 'zip_file')->fileInput()->label('Product Zip File');
    
    
    ?>

 <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
	</div>
</div>

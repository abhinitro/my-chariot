<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
use yii\helpers\ArrayHelper;
use app\models\Category;
use kartik\select2\Select2;
use app\models\SubCategory;

/* @var $this yii\web\View */
/* @var $model app\models\SubCategory */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sub-category-form">
	<div class="panel">
		<div class="panel-body">
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
    <?php
				$disabled = '';
				if (! empty ( $model->category_id )) {
					$disabled = 'disabled';
				}
				?>
    <?=$form->field ( $model, 'category_id' )->widget ( Select2::classname (), [ 'data' => ArrayHelper::map ( Category::find ()->all (), 'id', 'title' ),'options' => [ 'placeholder' => 'Select Category ...','enableAjaxValidation' => false ],'pluginOptions' => [ 'allowClear' => true ],"disabled" => $disabled ] )?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
    
     <?php
					echo $form->field ( $media, 'file_name' )->widget ( FileInput::classname (), [ 
							'options' => [ 
									'accept' => 'image/*' 
							] 
					] )->label ( 'Sub Category Image' );
					?>

<?= $form->field($model, 'state_id')->dropDownList($model->getStateOptions()) ?>

    <div class="row">
				<div class='col-md-10'>
 			<?= $form->field($model, 'keywords[]')->textInput(['maxlength' => true, 'placeholder'=>'Enter Keywords Here']) ?>
		</div>
				<div class='col-md-2'>
					<div class="input-group-btn">
						<button class="btn btn-success add-more" type="button">
							<i class="glyphicon glyphicon-plus"></i> Add
						</button>
					</div>
				</div>
			</div>

			<div class="appendInputType"></div>

			<div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
	</div>
</div>
<script>
var i=1;
$(".add-more").click(function() {
	var html ="<div class='row add-more-fields' id ='product-price-"+i+"'>";
	html += "<div class='col-md-10'><input type='text' id='product_min_quantity'name='SubCategory[keywords][]' class='form-control' placeholder='Enter Keywords Here'></div>";
    html += "<div class='col-md-2 '><button class='btn btn-success  remove-more-"+i+"'data-id="+i+" id='remove-more-"+i+"' type='button'><i class='glyphicon glyphicon-minus'></i></button></div>";
    html +="</div>";
    $(".appendInputType").append(html);
    i++;
});

$(document).on('click','[id^=remove-more-]',function(){
	id=$(this).attr('data-id');
	$("#product-price-"+id+"").remove();

});
</script>
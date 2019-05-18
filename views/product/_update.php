<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
use app\models\Category;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use app\models\Brand;
use app\models\SubCategory;
use yii\helpers\Url;
use app\models\ProductPrice;
use app\models\Deal;
use app\models\Product;
use app\models\Banner;

/* @var $this yii\web\View */
/* @var $model app\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

   <?php
$disabled = '';
if (! empty($model->category_id)) {
    $disabled = 'disabled';
}
?>
   

    <?=$form->field ( $model, 'sub_category_id' )->widget ( Select2::classname (), [ 'data' => ArrayHelper::map ( SubCategory::find ()->all (), 'id', 'title' ),'options' => [ 'placeholder' => 'Select Category ...' ],'pluginOptions' => [ 'allowClear' => true ],"disabled" => $disabled ] )?>

 
    <?=$form->field ( $model, 'brand_id' )->widget ( Select2::classname (), [ 'data' => ArrayHelper::map ( Brand::find ()->all (), 'id', 'title' ),'options' => [ 'placeholder' => 'Select Brand ...' ],'pluginOptions' => [ 'allowClear' => true ],"disabled" => $disabled ] )?>

    <?=$form->field ( $model, 'deal_id' )->widget ( Select2::classname (), [ 'data' => ArrayHelper::map ( Deal::find ()->all (), 'id', 'title' ),'options' => [ 'placeholder' => 'Select Deal ...' ],'pluginOptions' => [ 'allowClear' => true ] ] )?>

    <?= $form->field($model, 'banner_id')->widget(Select2::classname(), ['data' => ArrayHelper::map(Banner::find()->where(['state_id' => Deal::STATE_ACTIVE])->all(), 'id', 'title'), 'options' => ['placeholder' => 'Select Banner ...'], 'pluginOptions' => ['allowClear' => true]]) ?>

    <?= $form->field($model, 'part_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'amount')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
    
     <?= $form->field($model, 'discount')->textInput(['rows' => 6]) ?>

      <?php
    echo $form->field($media, 'file_name[]')
        ->widget(FileInput::classname(), [
        'options' => [
            'accept' => 'image/*',
            'multiple' => true
        ]
    ])
        ->label('Product Images');
    ?>


 <?=$form->field ( $model, 'product_ids' )->widget ( Select2::classname (), [ 'data' => ArrayHelper::map ( Product::find ()->where(['state_id'=>Product::STATE_ACTIVE])->all (), 'id', 'title' ),'options' => [ 'placeholder' => 'Select Compatible Printer' ],'pluginOptions' => [ 'allowClear' => true,'multiple'=>true ] ] )?>
        


<?php

$productPrices = ProductPrice::find()->where([
    'product_id' => $model->id
])->all();
if (! empty($productPrices)) {
    foreach ($productPrices as $productPrice) {
        ?>
 <div class="row" id='product-price-remove-<?=$productPrice->id?>'>
		<div class='col-md-3'>
 <?= $form->field($productPrice, 'min_quantity[]')->textInput(['maxlength' => true,'value'=>$productPrice->min_quantity]) ?>
</div>
		<div class='col-md-3'>
 <?= $form->field($productPrice, 'max_quantity[]')->textInput(['maxlength' => true,'value'=>$productPrice->max_quantity]) ?>
 </div>
		<div class='col-md-3'>
  <?= $form->field($productPrice, 'price[]')->textInput(['maxlength' => true,'value'=>$productPrice->price]) ?>
</div>
		<div class='col-md-3'>
			<button class='btn btn-success remove-more '
				id='alredy-remove-more-<?=$productPrice->id?>'
				remove-id='<?=$productPrice->id?>' type='button'>
				<i class='glyphicon glyphicon-minus'></i>
			</button>
		</div>
	</div>
<?php
    }
}
?>


    <div class="input-group-btn">
		<button class="btn btn-success add-more" type="button">
			<i class="glyphicon glyphicon-plus"></i> Add
		</button>
	</div>

	<div class="appendInputType"></div>
	
	
	


<?php

if (! empty($model->package_detail)) {
    $packages = json_decode($model->package_detail);
    {
        foreach ($packages as $key => $package) {
            ?>
          <div class="row" id='product-package-remove-<?=$key?>'>

		<div class='col-md-4'>

			<label><?=\yii::t('app','Package')?></label> <input type="text"
				name="Product[package][]" class='form-control'
				value='<?=$package->package ?>' placeholder='Enter Package'><br>
		</div>
		<div class='col-md-4'>

			<label><?=\yii::t('app','Package Quantity')?></label> <input
				type="text" name="Product[package_quantity][]" class='form-control'
				value='<?=$package->quantity ?>' placeholder='Enter Package Price'><br>
		</div>
		<div class='col-md-3'>
			<button class='btn btn-success product-remove-more '
				id='product-remove-more-<?=$key?>' remove-id='<?=$key?>'
				type='button'>
				<i class='glyphicon glyphicon-minus'></i>
			</button>
		</div>
	</div>
       <?php
        }
    }
}
?>



	

    <div class="input-group-btn">
		<button class="btn btn-success add-more-package" type="button">
			<i class="glyphicon glyphicon-plus"></i> Add
		</button>
	</div>

	<div class="appendPackageInputType"></div>
	
	
	
	
	
	
	
		  <?= $form->field($model, 'youtube_link')->textInput(['rows' => 6]) ?>
	
 
 
 <iframe id="video" width="1000" height="400" src="" frameborder="0"
		allowfullscreen></iframe>
	
					  
					  <?= $form->field($model, 'state_id')->dropDownList($model->getStateOptions()) ?>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<script>
$(document).ready(function(){
	var video=$('#product-youtube_link').val();

	if((video!='') && (video!='undefined'))
	{
		$('#video').show();

		$('#video').attr('src',video) 
		video += "&autoplay=1";
		
	}else
	{
		$('#video').hide();
	}	
});

		



var i=1;
$(".add-more").click(function(){
	
	var html ="<div class='row' id ='product-price-"+i+"'>";
	 html += "<div><div class='col-md-3'><input type='text' id='product_min_quantity'name='ProductPrice[min_quantity][]' class='form-control' placeholder='Enter Min Quantity Here'></div>";
    html += "<div class='col-md-3'><input type='text'id='product_max_quantity' name='ProductPrice[max_quantity][]' class='form-control' placeholder='Enter Max Quantity Here'></div>";
    html += "<div class='col-md-3'><input type='text' id='product_amount' name='ProductPrice[price][]' class='form-control' placeholder='Enter Price Here'></div>";
    html += "<div class='col-md-3 remove'><button class='btn btn-success remove-more-"+i+"' data-id="+i+" id='remove-more-"+i+"' type='button'><i class='glyphicon glyphicon-minus'></i></button></div>";
    html +="</div>";
    
    $(".appendInputType").append(html);
     i++;
});




var i = 1;
$(".add-more-package").click(function () {
    var html = "<div class='row add-more-fields' id ='product-price-" + i + "'>";
    html += "<div class='col-md-4'><input type='text' id='product_package'name='Product[package][]' class='form-control' placeholder='Enter Package'></div>";
    html += "<div class='col-md-4'><input type='text'id='product_package_quantity' name='Product[package_quantity][]' class='form-control' placeholder='Enter Package Price'></div>";
    html += "<div class='col-md-3 '><button class='btn btn-success  remove-more-package" + i + "'data-id=" + i + " id='remove-more-package" + i + "' type='button'><i class='glyphicon glyphicon-minus'></i></button></div>";
    html += "</div>";
    $(".appendPackageInputType").append(html);
    i++;
});


$(document).on('click','[id^=remove-more-]',function(){
	var id=$(this).attr('data-id');
	$("#product-price-"+id+"").remove();

});



$(document).on('click','[id^=product-remove-more-]',function(){
	var id=$(this).attr('remove-id');
	$("#product-package-remove-"+id+"").remove();

});


$("[id^=alredy-remove-more]").click(function(e){
	
	var id=$(this).attr('remove-id');
	
	$("#product-price-remove-"+id+"").remove();

});


$('#product-youtube_link').on('keyup', function(e) {
	$('#video').show();
$('#video').attr('src',$(this).val()) 
$(this).val() += "&autoplay=1";
e.preventDefault();
	 
	  });
</script>
<?php
use app\models\Brand;
use app\models\Category;
use app\models\SubCategory;
use kartik\file\FileInput;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
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
    
    <?= $form->field($model, 'category_id')->widget(Select2::classname(), ['data' => ArrayHelper::map(Category::find()->where(['state_id' => Category::STATE_ACTIVE])->all(), 'id', 'title'), 'options' => ['placeholder' => 'Select Category ...'], 'pluginOptions' => ['allowClear' => true]]) ?>
    
    <?= $form->field($model, 'sub_category_id')->dropDownList([]) ?>

    <?= $form->field($model, 'brand_id')->widget(Select2::classname(), ['data' => ArrayHelper::map(Brand::find()->where(['state_id' => Brand::STATE_ACTIVE])->all(), 'id', 'title'), 'options' => ['placeholder' => 'Select Brand ...'], 'pluginOptions' => ['allowClear' => true]]) ?>

    <?= $form->field($model, 'deal_id')->widget(Select2::classname(), ['data' => ArrayHelper::map(Deal::find()->where(['state_id' => Deal::STATE_ACTIVE])->all(), 'id', 'title'), 'options' => ['placeholder' => 'Select Deal ...'], 'pluginOptions' => ['allowClear' => true]]) ?>

    <?= $form->field($model, 'banner_id')->widget(Select2::classname(), ['data' => ArrayHelper::map(Banner::find()->where(['state_id' => Banner::STATE_ACTIVE])->all(), 'id', 'title'), 'options' => ['placeholder' => 'Select Banner ...'], 'pluginOptions' => ['allowClear' => true]]) ?>

    <?= $form->field($model, 'part_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'amount')->textInput(['maxlength' => true]) ?>

    <?=$form->field($model, 'description')->widget(\dosamigos\ckeditor\CKEditor::className(), ['options' => ['rows' => 6],'preset' => 'full'])?>

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
    <?= $form->field($model, 'product_ids')->widget(Select2::classname(), ['data' => ArrayHelper::map(Product::find()->where(['state_id' => Product::STATE_ACTIVE])->all(), 'id', 'title'), 'options' => ['placeholder' => 'Select Compatible Printer'], 'pluginOptions' => ['allowClear' => true, 'multiple' => true]]) ?>


    <div class="row">
		<div class='col-md-3'>
            <?= $form->field($productPrice, 'min_quantity[]')->textInput(['maxlength' => true, 'placeholder' => 'Enter Min Quantity Here']) ?>
        </div>
		<div class='col-md-3'>
            <?= $form->field($productPrice, 'max_quantity[]')->textInput(['maxlength' => true, 'placeholder' => 'Enter Max Quantity Here']) ?>
        </div>
		<div class='col-md-3'>
            <?= $form->field($productPrice, 'price[]')->textInput(['maxlength' => true, 'placeholder' => 'Enter Price Here']) ?>
        </div>
		<div class='col-md-3'>
			<div class="input-group-btn">
				<button class="btn btn-success add-more" type="button">
					<i class="glyphicon glyphicon-plus"></i> Add
				</button>
			</div>
		</div>
	</div>

	<div class="appendInputType"></div>


	<div class="row">
		<div class='col-md-4'>

			<label><?=\yii::t('app','Package')?></label> <input type="text"
				name="Product[package][]" class='form-control'
				placeholder='Enter Package'><br>
		</div>
		<div class='col-md-4'>

			<label><?=\yii::t('app','Package Quantity')?></label> <input
				type="text" name="Product[package_quantity][]" class='form-control'
				placeholder='Enter Package Price'><br>
		</div>
		<div class='col-md-3'>
			<div class="input-group-btn">


				<button class="btn btn-success add-more-package" type="button">
					<i class="glyphicon glyphicon-plus"></i> Add
				</button>
			</div>
		</div>
	</div>




	<div class="appendPackageInputType"></div>
    

   
    <?= $form->field($model, 'youtube_link')->textInput(['rows' => 6]) ?>


    <div id="youtubeLink"></div>


    <?= $form->field($model, 'state_id')->dropDownList($model->getStateOptions()) ?>

    <div class="row">
		<div class='col-md-10'>
            <?= $form->field($model, 'keywords[]')->textInput(['maxlength' => true, 'placeholder' => 'Enter Keywords Here']) ?>
        </div>
		<div class='col-md-2'>
			<div class="input-group-btn">
				<button class="btn btn-success add-more-keywords" type="button">
					<i class="glyphicon glyphicon-plus"></i> Add
				</button>
			</div>
		</div>
	</div>

	<div class="appendKeywordInputType"></div>

	<div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<script>
    var i = 1;
    $(".add-more-keywords").click(function () {
        var html = "<div class='row add-more-keyword-fields' id ='product-keyword-" + i + "'>";
        html += "<div class='col-md-10'><input type='text' id='product_min_quantity'name='Product[keywords][]' class='form-control' placeholder='Enter Keywords Here'></div>";
        html += "<div class='col-md-2 '><button class='btn btn-success  remove-keyword-" + i + "'data-id=" + i + " id='remove-keyword-" + i + "' type='button'><i class='glyphicon glyphicon-minus'></i></button></div>";
        html += "</div>";
        $(".appendKeywordInputType").append(html);
        i++;
    });

    $(document).on('click', '[id^=remove-keyword-]', function () {
        id = $(this).attr('data-id');
        $("#product-keyword-" + id + "").remove();

    });

    $('#video').hide();
    var i = 1;
    $(".add-more").click(function () {
        var html = "<div class='row add-more-fields' id ='product-price-" + i + "'>";
        html += "<div class='col-md-3'><input type='text' id='product_min_quantity'name='ProductPrice[min_quantity][]' class='form-control' placeholder='Enter Min Quantity Here'></div>";
        html += "<div class='col-md-3'><input type='text'id='product_max_quantity' name='ProductPrice[max_quantity][]' class='form-control' placeholder='Enter Max Quantity Here'></div>";
        html += "<div class='col-md-3'><input type='text' id='product_amount' name='ProductPrice[price][]' class='form-control' placeholder='Enter Price Here'></div>";
        html += "<div class='col-md-3 '><button class='btn btn-success  remove-more-" + i + "'data-id=" + i + " id='remove-more-" + i + "' type='button'><i class='glyphicon glyphicon-minus'></i></button></div>";
        html += "</div>";
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




    $(document).on('click', '[id^=remove-more-]', function () {
        id = $(this).attr('data-id');
        $("#product-price-" + id + "").remove();

    });

    $('#product-youtube_link').on('keyup', function (e) {
        $("#youtubeLink").html('');
        $("#youtubeLink").html($(this).val());
    });

    $("#product-category_id").on('change', function () {
        var id = $(this).val();
        if ( id ) {
        	searchSubCategory(id);
		}
	});

    $(document).ready( function () {
        setTimeout(function () {
        	var id = $("#product-category_id").val();
            if ( id ) {
            	searchSubCategory(id);
    		}   
		}, '1000');
	});

	function searchSubCategory (id) {
		$.ajax({
        	url : "<?= Url::toRoute(['product/subcategory']) ?>?id="+id,	
			type : 'GET',
			success : function (response) {
				if ( typeof response.result != 'undefined' ) {
					var html = "";
					$.each(response.result, function (key,value) {
						html += "<option value="+key+">"+value+"</option>";
					});
					$("#product-sub_category_id").empty();
					$("#product-sub_category_id").html(html);
				}
			}
    	});
	}

</script>
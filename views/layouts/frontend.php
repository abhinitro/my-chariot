<?php
use yii\helpers\Html;
use yii\helpers\Url;
use app\models\User;

/* @var $this \yii\web\View */
/* @var $content string */

app\assets\FrontendAsset::register($this);
Yii::$app->assetManager->bundles['yii\web\JqueryAsset'] = false;

$model = new \app\models\Category();

$categories = $model->getCategoryLIst();

?>
    <?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
<meta charset="<?= Yii::$app->charset ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
        
	<!-- Google font -->
<link href="https://fonts.googleapis.com/css?family=PT+Sans:400,700"
	rel="stylesheet">

<!-- Bootstrap -->
<link type="text/css" rel="stylesheet"
	href="<?= \Yii::$app->view->theme->getUrl('/frontend/css') ?>/slick.css" />
<link type="text/css" rel="stylesheet"
	href="<?= \Yii::$app->view->theme->getUrl('/frontend/css') ?>/slick-theme.css" />

<!-- nouislider -->
<link type="text/css" rel="stylesheet"
	href="<?= \Yii::$app->view->theme->getUrl('/frontend/css') ?>/nouislider.min.css" />

<!-- Font Awesome Icon -->
<link rel="stylesheet"
	href="<?= \Yii::$app->view->theme->getUrl('/frontend/css') ?>/font-awesome.min.css">

<link rel="stylesheet"
	href="<?= \Yii::$app->view->theme->getUrl('/frontend/css') ?>/jquery.fancybox.css">

<!-- Custom stlylesheet -->


<link rel="stylesheet" type="text/css"
	href="<?= \Yii::$app->view->theme->getUrl('/frontend/css/frontend.css') ?>">
<link type="text/css" rel="stylesheet"
	href="<?= \Yii::$app->view->theme->getUrl('/frontend/css') ?>/style.css" />

<link rel="stylesheet" type="text/css"
	href="<?= \Yii::$app->view->theme->getUrl('/frontend/css/jquery.toast.css') ?>">


<script
	src="<?= \Yii::$app->view->theme->getUrl('/frontend/js') ?>/jquery.toast.js"></script>

<script
	src="<?= \Yii::$app->view->theme->getUrl('/frontend/js') ?>/add_to_cart.js"></script>

<script
	src="<?= \Yii::$app->view->theme->getUrl('/frontend/js') ?>/toast.js"></script>

<script type='text/javascript'
	src='//platform-api.sharethis.com/js/sharethis.js#property=5b22c81343580f00113f43aa&product=custom-share-buttons'
	async='async'></script>

<script
	src="<?= \Yii::$app->view->theme->getUrl('/frontend/js') ?>/slick.min.js"></script>
<script
	src="<?= \Yii::$app->view->theme->getUrl('/frontend/js') ?>/nouislider.min.js"></script>

<script
	src="<?= \Yii::$app->view->theme->getUrl('/frontend/js') ?>/jquery.fancybox.js"></script>

<script
	src="<?= \Yii::$app->view->theme->getUrl('/frontend/js') ?>/jquery.elevatezoom.js"></script>

<!-- BREADCRUMB -->
<style>
.st-custom-button[data-network] {
	border-style: ridge;
	border-width: 1px;
	width: 40px;
	height: 40px;
	background-color: #ffffff;
	display: inline-block;
	padding: 7px 10px;
	cursor: pointer;
	font-weight: bold;
	color: #30323a;
}
</style>


</head>
<body ng-app="ShopingCart">
    <?php $this->beginBody() ?>
    
    <?php
    echo $this->render('main-header', [
        'categories' => $categories
    ]);
    ?>
    
	<!-- /HEADER -->
	<!-- /NAVIGATION -->

	<!-- /NAVIGATION -->
	<div id="home">
		<!-- container -->
		<div class="container">
    		<?= $content;?>
		</div>
		<!-- /container -->
	</div>
	<?php
echo $this->render('main-footer');
?>

	<!-- Javascript -->




	<script type="text/javascript">
<!--

//-->

$(document).on('click','button[id^="add_to_cart_"]',function(){

var id=$(this).attr('data-id');
var url='<?=Url::toRoute(['cart/add-to-cart'])?>';
var method='POST';
var csrf='<?=\Yii::$app->request->csrfToken ?>';
var amount=$(this).attr('data-amount');
add_to_cart(id,url,method,amount,csrf);
	
});



function add_to_cart(id, url, method, amount, csrf) {


	var new_csrf='<?=\Yii::$app->request->csrfToken ?>';
	var new_url='<?=Url::toRoute('/cart/delete-from-cart'); ?>';
	
	

	var qty = $('#product_qyt_' + id).val();
	if (!qty) {
		qty = 1;
	}
    $.ajax({
      url : url,
		type : method,
		data : {
			product_id : id,
			qty : qty,
			amount : amount,
			_csrf : csrf
		},
		success : function(response) {
			console.log(response);
           if (response.status == 'Success!') {
               //this function is defined in themes/frontend/js/toast.js
				renderToast(response.message, response.status, 'success');
				//this function is defined in themes/frontend/js/add_to_cart.js
					if(response.flag==1){
		                $('#add-cart-list').append(appendHTML(response.details,new_csrf,new_url));
						
					}
			   $('#quantity-of-product').html(response.details.count);

			   console.log(response.details.count);
			   $('#qty_'+response.details.id).html("x "+response.details.qty);
			   
			} else {
				renderToast(response.message, response.status, 'error');
            }

		}

	});

}


$(document).on('click','a[id^=add_to_wishlist_]',function(){


var id=$(this).attr('data-id');


add_to_wishlist(id);

	
});








function add_to_wishlist(id){

	
	$.ajax({
		  url: "<?=Url::toRoute(['wishlist/add-to-wishlist']) ?>",
		  type: "POST",
		  data: {
			    id : id,
			    _csrf:'<?=\Yii::$app->request->csrfToken ?>'
             },
		 success:function(response){

             if(response.status=="OK"){
            	 renderToast(response.message,response.heading,'success');
                 if(response.is_added==1){
                   $('#change-heart-class').removeClass();
                   $('#change-heart-class').addClass('fa fa-heart');
                     }else{
                    	 $('#change-heart-class').removeClass();
                         $('#change-heart-class').addClass('fa fa-heart-o');
                      }

            	 
             }else{
            	 renderToast(response.message,response.heading,'danger');
             }
			 
		 }


});
	   

}


$(document).on('click','a[id^=search_part_number]',function(){

		var part=$('#part-form').find('input[name="Product[part_number]"]').val();//$("#part-form")[0].value;
		var link=window.location.href+'&partNumber='+part;
		window.location=link;
	//alert(link);

		
	});
var slider = document.getElementById('price-slider');
var x=1;
var y=999;
if (slider) {
//	alert("hello");
  noUiSlider.create(slider, {
    start: [1, 999],
    connect: true,
    tooltips: [true, true],
    format: {
      to: function(value) {
        return value.toFixed(2) + '$';
      },
      from: function(value) {
        return value
      }
    },
    range: {
      'min': 1,
      'max': 999
    }
  });
}



</script>




	<script
		src="<?= \Yii::$app->view->theme->getUrl('/frontend/js') ?>/slick.min.js"></script>
	<script
		src="<?= \Yii::$app->view->theme->getUrl('/frontend/js') ?>/nouislider.min.js"></script>
	<script
		src="<?= \Yii::$app->view->theme->getUrl('/frontend/js') ?>/jquery.zoom.min.js"></script>
	<script
		src="<?= \Yii::$app->view->theme->getUrl('/frontend/js') ?>/main.js"></script>

	<script
		src="<?= \Yii::$app->view->theme->getUrl('/frontend/js') ?>/style.js"></script>

	<script
		src="<?= \Yii::$app->view->theme->getUrl('/frontend/js') ?>/custom.js"></script>

    <?php $this->endBody() ?>
  </body>
</html>
<?php $this->endPage() ?>

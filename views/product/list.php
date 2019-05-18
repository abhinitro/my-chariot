<?php
use yii\helpers\Url;
?>
<style>
<!--
.sub-items:nth-child(n+2) {
	margin-left: 1em;
}
-->
</style>
<!-- BREADCRUMB -->
<div id="breadcrumb">
	<div class="container">
		<ul class="breadcrumb">
			<li><a href="<?= Url::home() ?>">Home</a></li>
			<li class="active">Products</li>
		</ul>
	</div>
</div>
<!-- /BREADCRUMB -->

<!-- section -->
<div class="section">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row">
			<!-- ASIDE -->
			<div id="aside" class="col-md-3">
				<!-- aside widget -->
				<!-- /aside widget -->


				<!-- aside widget -->
				<div class="aside">
					<h3 class="aside-title">Filter By Part Number:</h3>
					<div class="row">
						<div class="col-md-9">
							<form id="part-form">
								<Input type="input" class="input seacrh-input"
									name="Product[part_number]" placeholder="Enter part number..."
									id="input_value">
							</form>
						</div>
						<div class="col-md-3">
							<a href="javascript:" class="btn search-by-partnumber"
								id="search_part_number">Find</a>
						</div>
					</div>
				</div>
				<form id="filter-form">
					<!-- aside widget -->
					<!-- <div class="aside">
						<h3 class="aside-title">Filter by Price</h3>
						<div id="price-slider"></div>
					</div> -->
					<!-- aside widget -->

					<!-- aside widget -->
			<?php if(!empty($sub_categories)){?>
				<div class="aside">
						<h3 class="aside-title">Filter By Sub Category:</h3>
						<ul class="list-links">
					<?php foreach ($sub_categories as $sub){?>
						<li><input type="checkbox" name="Product[sub_category_id]"
								id="sub_cat_id_<?php echo $sub->id?>" value="<?=$sub->id?>"> <?= $sub->title?></li>
						<?php
        
        $child_sub_categories = $sub->getsubCategories($sub);
        if (! empty($child_sub_categories)) {
            foreach ($child_sub_categories as $cat) {
                ?>
						
						<li class="sub-items"><input type="checkbox"
								name="Product[sub_category_id]" value="<?=$cat->id?>"> <?= $cat->title?></li>
						<?php
            }
        }
        ?>
						
					<?php }?>
					
					</ul>
					</div>
				<?php }?>
				<!-- /aside widget -->


					<!-- /aside widget -->

					<!-- aside widget -->
					<div class="aside">
						<h3 class="aside-title">Filter by Brand</h3>
						<ul class="list-links">
					<?php foreach ($brands as $brand) {?>
						<li><input type="checkbox" name="Product[brand]"
								id="check_<?=$brand->brand_id?>" value="<?=$brand->brand_id ?>"><?= $brand->title?></li>
						<?php }?>
					</ul>
					</div>

				</form>
				<!-- /aside widget -->

				<!-- aside widget -->
				<!-- 				<div class="aside"> -->
				<!-- 					<h3 class="aside-title">Filter by Gender</h3> -->
				<!-- 					<ul class="list-links"> -->
				<!-- 						<li class="active"><a href="#">Men</a></li> -->
				<!-- 						<li><a href="#">Women</a></li> -->
				<!-- 					</ul> -->
				<!-- 				</div> -->
				<!-- /aside widget -->

				<!-- aside widget -->
			</div>
			<!-- /ASIDE -->

			<!-- MAIN -->
			<div id="main" class="col-md-9">
				<!-- store top filter -->
				<div class="store-filter clearfix">
					<!-- <div class="pull-left">
						<div class="row-filter">
							<a href="#"><i class="fa fa-th-large"></i></a> <a href="#"
								class="active"><i class="fa fa-bars"></i></a>
						</div>

					</div> -->
					<div class="col-md-12">
						<div class="sort-by">
							<span><?= yii::t('app', 'Sort BY') ?>:</span> <span><a
								href="<?= Url::toRoute(['product/list', 'sortBy' => 'default']) ?>"><?= Yii::t('app', 'Default') ?></a></span>
							<span class="vl"></span> <span> <a
								href="<?= Url::toRoute(['product/list', 'sortBy' => 'price']) ?>"><?= Yii::t('app', 'Price Low or High') ?></a>
								<i class="fa fa-long-arrow-up"></i> <i
								class="fa fa-long-arrow-down"></i>
							</span> <span class="vl"></span> <span><a
								href="<?= Url::toRoute(['product/list', 'sortBy' => 'new']) ?>"><?= Yii::t('app', 'New Arrivals') ?></a></span>
							<span class="vl"></span> <span><a
								href="<?= Url::toRoute(['product/list', 'sortBy' => 'rate']) ?>"><?= Yii::t('app', 'Highest Rating') ?></a></span>
						</div>
					</div>
					<!-- <div class="sort-filr pull-right "> -->
					<!-- <span class="text-uppercase">Sort By:</span> <select class="input"
							id="sort_by">
							<option value="postion">Position</option>
							<option value="amount">Price</option>
							<option value="rating">Rating</option>
						</select> -->
					<!-- 							<a href="#" class="main-btn icon-btn"><i -->
					<!-- 								class="fa fa-arrow-down"></i></a> -->
					<!-- </div> -->
					<!-- 					<div class="pull-right"> -->
					<!-- 						<div class="page-filter"> -->
					<!-- 							<span class="text-uppercase">Show:</span> <select class="input"> -->
					<!-- 								<option value="0">10</option> -->
					<!-- 								<option value="1">20</option> -->
					<!-- 								<option value="2">30</option> -->
					<!-- 							</select> -->
					<!-- 						</div> -->
					<!-- 						<ul class="store-pages"> -->
					<!-- 							<li><span class="text-uppercase">Page:</span></li> -->
					<!-- 							<li class="active">1</li> -->
					<!-- 							<li><a href="#">2</a></li> -->
					<!-- 							<li><a href="#">3</a></li> -->
					<!-- 							<li><a href="#"><i class="fa fa-caret-right"></i></a></li> -->
					<!-- 						</ul> -->
					<!-- 					</div> -->
				</div>
				<!-- /store top filter -->

				<!-- STORE -->
				<div id="store">
					<!-- row -->
					<div class="row" id="result_set">
						<!-- Product Single -->
 <?php

\yii\widgets\Pjax::begin([
    'enablePushState' => false,
    'clientOptions' => [
        'method' => 'GET'
    ]
]);
?>

                        <?= \Yii::$app->controller->renderPartial('_product-list',['dataProvider'=>$dataProvider])?>
                          <?php \yii\widgets\Pjax::end(); ?>
						<!-- /Product Single -->
					</div>
					<!-- /row -->
				</div>
				<!-- /STORE -->

				<!-- store bottom filter -->
				<!-- <!-- <div class="store-filter clearfix">
					<div class="pull-left">
						<div class="row-filter">
							<a href="#"><i class="fa fa-th-large"></i></a> <a href="#"
								class="active"><i class="fa fa-bars"></i></a>
						</div>
						<div class="sort-filter">
							<span class="text-uppercase">Sort By:</span> <select
								class="input">
								<option value="0">Position</option>
								<option value="0">Price</option>
								<option value="0">Rating</option>
							</select> <a href="#" class="main-btn icon-btn"><i
								class="fa fa-arrow-down"></i></a>
						</div>
					</div>
					<div class="pull-right">
						<div class="page-filter">
							<span class="text-uppercase">Show:</span> <select class="input">
								<option value="0">10</option>
								<option value="1">20</option>
								<option value="2">30</option>
							</select>
						</div>
						<ul class="store-pages">
							<li><span class="text-uppercase">Page:</span></li>
							<li class="active">1</li>
							<li><a href="#">2</a></li>
							<li><a href="#">3</a></li>
							<li><a href="#"><i class="fa fa-caret-right"></i></a></li>
						</ul>
					</div>
				</div>
			 -->
				<!-- /store bottom filter -->
			</div>
			<!-- /MAIN -->
		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</div>
<!-- /section -->


<script type="text/javascript">
<!--

//-->
//PRICE SLIDER


// $(document).on("change","#filter-form",function(){



// var form=  $(this).serializeArray();
// // console.log(form);
// // var arr=[];
// // form.forEach(function(element){
	
// // 	arr.push(element['value']);
// // });
// // var url=window.location.href
// // var obj = { Page: '', Url: window.location.href+"&brand="+arr };
// // history.pushState(obj, obj.Page, obj.Url);
// $.ajax({
	 // url: "<?//=Url::toRoute(['/product/get-search']) ?>",
// 	  type: "POST",
// 	  data: {
// 		     model : form,
		   // _csrf:"<?//=\Yii::$app->request->csrfToken ?>"
//        },
// 	 success:function(response){
// 		 if(response['status']=='OK')
// 		 {
// 			 $("#store").html(response['res']);
// 		 }
		 

//      }


// });
	
// });
// $(document).ready(function() {

// 	var link=window.location.href
// 	var arr=checkedUrl( link);
// 	if(arr!=null){

// 		for(index=0;index<arr.length;index++){
// 			document.getElementById("check_"+arr[index]).checked = true;
// 		}
// 	}
//  });

function checkedUrl( url){
	var tt=false;
	var str_array = url.split('&');	
	console.log(str_array);
	var result=str_array[0];
	for (index = 1; index < str_array.length; ++index) {
	    value = str_array[index];
	    if (value.substring(0, 9) === "brand_id=") {
		    tt=true;
	        var pp=value.substring(9,value.length);
	        var kk=[];
	       kk =pp.split(',');   
	       return kk; 
	    }
	    
	}
	return null;
	
}

function createUrl( url,arr,key){
	var tt=false;
	var str_array = url.split('&');	
	//console.log(str_array);
	var result=str_array[0];
	for (index = 1; index < str_array.length; ++index) {
	    value = str_array[index].split('=');
	    if (value.length>0 &&  value[0]===key ) {
		    if(arr.length>0){
			    
		    tt=true;
		    
		   result+='&'+key+'='+arr
		    }
	    }else{
		    result+='&'+str_array[index];
	    }
	    
	}
	if(tt==false && arr.length>0)
	{
		result+='&'+key+'='+arr;
	}
	//alert(result);
	return result;
}

var arr=[];
$('input[id^="check_"]').on('click',function(){
	
	var id=this.value;
	if( $(this).is(':checked') ){
		arr.push(id);	
	}else{
		var index1 = arr.indexOf(id);
    	
		if (index1 > -1) {
		  arr.splice(index1, 1);
		}  
	}
	 var link1=window.location.href;
	 var link2=createUrl(link1,arr,'brand_id');
	$.ajax({
		 url: link2+'&flag='+true,
        type: "GET",                        
        success: function(data){
            if(data['status']=='OK'){
            	 //var link1=window.location.href;
            	 history.pushState({}, null, link2);
            	// window.location=link2;
               //  history.pushState(null, null,link2);
                 $('#result_set').html(data['res']);
               
            }
           console.log(data);
        }
});

	});
var arr12=[];
$('input[id^="sub_cat_id_"]').on('click',function(){
	var id=this.value;
	if( $(this).is(':checked') ){
		arr12.push(id);	
	}else{
		var index1 = arr12.indexOf(id);
    	
		if (index1 > -1) {
		  arr12.splice(index1, 1);
		}  
	}
	 var link1=window.location.href;
	 var link2=createUrl(link1,arr12,'sub_cat_cat_id');
	$.ajax({
		 url: link2+'&flag='+true,
        type: "GET",                        
        success: function(data){
            if(data['status']=='OK'){
            	 //var link1=window.location.href;
            	 history.pushState({}, null, link2);
            	// window.location=link2;
               //  history.pushState(null, null,link2);
                 $('#result_set').html(data['res']);
               
            }
           
        }
});
});
$('#sort_by').on('change',function(){
	
var val=this.value;

var id=this.value;
if( $(this).is(':checked') ){
	arr12.push(id);	
}else{
	var index1 = arr12.indexOf(id);
	
	if (index1 > -1) {
	  arr12.splice(index1, 1);
	}  
}
 var link1=window.location.href;
 var link2=createUrl(link1,val,'sortBy');
$.ajax({
	 url: link2+'&flag='+true,
    type: "GET",                        
    success: function(data){
        if(data['status']=='OK'){
        	 //var link1=window.location.href;
        	 history.pushState({}, null, link2);
        	// window.location=link2;
           //  history.pushState(null, null,link2);
             $('#result_set').html(data['res']);
           
        }
       
    }
});
});
</script>




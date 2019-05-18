<?php
use yii\helpers\Url;
?>
<script>
$(document).on('click','button[id^="add_to_cart_"]',function(){

	var id=$(this).attr('data-id');
	var url='<?=Url::toRoute(['cart/add-to-cart'])?>';
	var method='POST';
	var csrf='<?=\Yii::$app->request->csrfToken ?>';
	var amount=$(this).attr('data-amount');
	add_to_cart(id,url,method,amount,csrf);
		
	});


/**
 * 
 */

function add_to_cart(id, url, method, amount, csrf) {

	var qty = $('product_qyt_' + id).val();
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
				renderToast(response.message, response.status, 'success');
			} else {
				renderToast(response.message, response.status, 'error');

			}

		}

	});

}

public function appendHTML(response,csrf) {

	html = '';
    html += '<div class="product product-widget">';
	html += '<div class="product-thumb">';
	html += '<img src="/sharing-cart/uploads/main-product02_1528546129.jpg" alt="product1">';
	html += '</div>';
	html += '<div class="product-body">';
	html += '<h3 class="product-price">';
	html += '1 <span class="qty">x3</span>';
	html += '</h3>';
	html += '<h2 class="product-name">';
	html += '<a href="#">product1</a>';
	html += '</h2>';
	html += '</div>';
	html += '<form id="w0" action="/sharing-cart/cart/delete-from-cart?id=6" method="post" class="ng-pristine ng-valid">';
	html += '<input type="hidden" name="_csrf" value="eXPg0f45nTm-1Y1UbGVxQlPUlzkw76wjozDRnp-v4E4QML-IvWjND_KkwxMiDTgkEafUXGOw60CQYLbn7JnWOg==" autocomplete="off">';
	html += '<button type="submit" class="cancel-btn">';
	html += '<i class="fa fa-trash"></i>';
	html += '</button>';
	html += '</form>';
	html += '</div>';
	return html;

}



































</script>
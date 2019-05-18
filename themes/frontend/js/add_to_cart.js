function appendHTML(response, csrf, url) {
	console.log(url);
	html = '';
	html += '<div class="product product-widget">';
	html += '<div class="product-thumb">';
	html += response.image_url;
	html += '</div>';
	html += '<div class="product-body">';
	html += '<h3 class="product-price">';
	html += response.amount + '<span class="qty" id="qty_'+response.id +'">x' + response.qty + '</span>';
	html += '</h3>';
	html += '<h2 class="product-name">';
	html += '<a href="#">' + response.product_title + '</a>';
	html += '</h2>';
	html += '</div>';
	html += '<form id="w0" action="' + url + '?id='
			+ response.id + '" method="post" class="ng-pristine ng-valid">';
	html += '<input type="hidden" name="_csrf" value="' + csrf
			+ '" autocomplete="off">';
	html += '<button type="submit" class="cancel-btn">';
	html += '<i class="fa fa-trash"></i>';
	html += '</button>';
	html += '</form>';
	html += '</div>';
	return html;

}

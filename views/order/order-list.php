<?php
use yii\widgets\ListView;
use yii\helpers\Url;
use yii\widgets\Pjax;
// var_dump($dataProvider->getModels());
// exit;
Pjax::begin ( [ 
		'enablePushState' => false 
] );
echo ListView::widget ( [ 
		'dataProvider' => $dataProvider,
		'itemView' => '_product',
		// 'layout' => "{items}\n<tr><td>{pager}</td></tr>",
		// 'options' => [
		// 'tag' => 'table',
		// ],
		'itemOptions' => [ 
				'tag' => false 
		] 
] );
Pjax::end ();
?>

<script
	src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBiOT-DPYPy02zWd5_XIkHA_HlVIregij0&libraries=places&callback=initialize"
	async defer></script>

<script type="text/javascript">

$('[id^=quantity_]').on('change',function(){
	var id=$(this).attr('text');
	var oldValue=$(this).attr('oldValue');
	var quantity=this.value;
	
	var myKeyVals = { id : id, count : quantity}
	$.ajax({
	    type: "POST",
	    url: '<?= Url::toRoute(['/cart/update-quantity']) ?>',
	    data:myKeyVals
	    });
	var amount=parseFloat($("#"+id).text());
	
	var old_amount=amount*oldValue;
	var new_amount=amount*quantity;
	var total_amount=amount*quantity;
	$("#total-amount_"+id).text("$"+total_amount.toFixed(2));	
	var sub=parseFloat($("#sub_total").text());
	
	//$(this).setAttribute('oldValue',quantity);
	$(this).attr('oldValue',quantity);
	sub=sub+new_amount-old_amount;
	$('#amount').val(total_amount);
	$("#sub_total").text(sub.toFixed(2));
	$("#order-amount").value=sub.toFixed(2);
	$("#total_amount").text(sub.toFixed(2));
	$("#order-amount").val(sub.toFixed(2));
});







	$("#order-address").on('focus', function () {
	    geolocate();
	});

	var placeSearch, autocomplete;
	var componentForm = {
	    //street_number: 'short_name',
	   // route: 'long_name',
	    locality: 'order-city',
	   // administrative_area_level_1: 'short_name',
	    country: 'order-country',
	   // postal_code: 'short_name'
	};

	var componentForm = {
		    city: 'long_name',
		    country: 'long_name',
	        postal_code: 'short_name'
		    
		};

	function initialize() {
	    // Create the autocomplete object, restricting the search
	    // to geographical location types.
	    autocomplete = new google.maps.places.Autocomplete(
	    /** @type {HTMLInputElement} */ (document.getElementById('order-address')), {
	        types: ['geocode']
	    });
	    // When the user selects an address from the dropdown,
	    // populate the address fields in the form.
	    google.maps.event.addListener(autocomplete, 'place_changed', function () {
	        fillInAddress();
	    });
	}

	// [START region_fillform]
	function fillInAddress() {
	    // Get the place details from the autocomplete object.
	    var place = autocomplete.getPlace();

	    document.getElementById("order-latitude").value = place.geometry.location.lat();
	    document.getElementById("order-longitude").value = place.geometry.location.lng();

	    for (var component in componentForm) {
	        document.getElementById(component).value = '';
	        document.getElementById(component).disabled = false;
	    }

	    // Get each component of the address from the place details
	    // and fill the corresponding field on the form.
	    for (var i = 0; i < place.address_components.length; i++) {
	        var addressType = place.address_components[i].types[0];
	        if (componentForm[addressType]) {
	            var val = place.address_components[i][componentForm[addressType]];
	            document.getElementById(addressType).value = val;
	        }
	    }
	}
	// [END region_fillform]

	// [START region_geolocation]
	// Bias the autocomplete object to the user's geographical location,
	// as supplied by the browser's 'navigator.geolocation' object.
	function geolocate() {
	    if (navigator.geolocation) {
	        navigator.geolocation.getCurrentPosition(function (position) {
	            var geolocation = new google.maps.LatLng(
	            position.coords.latitude, position.coords.longitude);

	            var latitude = position.coords.latitude;
	            var longitude = position.coords.longitude;
	            document.getElementById("order-latitude").value = latitude;
	            document.getElementById("order-longitude").value = longitude;

	            autocomplete.setBounds(new google.maps.LatLngBounds(geolocation, geolocation));
	        });
	    }

	}



</script>

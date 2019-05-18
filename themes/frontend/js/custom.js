var app = angular.module("ShopingCart", []);

app.controller("FaqController", function($scope) {
	$scope.activeFaq = "1";
	$scope.toggleFaq = function(faq) {
		console.log(faq);
		$scope.activeFaq = faq
	}
});
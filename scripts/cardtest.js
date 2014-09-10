var app = angular.module("CardApp", []);

app.controller("CardCtrl", function($scope, $http){
	$http.get('data/cards.json').
    success(function(data, status, headers, config) {
      $scope.cards = data;
	});
});




function DefaultCtrl($scope, $http, $window){

	$('form').find(':input:enabled:visible:first').focus().select();

	$scope.submit = function() {

		$http.post('/close-voting', $scope.item)
			.success(function(result) {
				$window.location.href = '/results';
			})
			.error(function(err) {
				alert(err.error.message);
			});
	};

}
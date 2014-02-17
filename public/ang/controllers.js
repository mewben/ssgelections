angular.module('ssg')
	.controller('AdminCtrl', [
		'$rootScope',
		'$scope',
		'$location',
		'Api',
		'Notify',
		function($rootScope, $scope, $location, Api, Notify) {

			var activePath = null;

			// initialize item every page
			$rootScope.menu = window.menu;
			$rootScope.sy_g = window.sy_g;
			$rootScope.sem_g = window.sem_g;
			$rootScope.item = {};
			$rootScope.itemParams = angular.extend({
				filter: 'active'
			}, $location.search());

			var successCallback = function() {
				$rootScope.query();
				Notify.successCallback();
			};

			$scope.$on('$routeChangeSuccess', function() {
				activePath = $location.path();
			});

			$scope.isActive = function(pattern) {
				return (new RegExp(pattern)).test(activePath);
			};

			$scope.changeFilter = function(filter) {
				$rootScope.itemParams.filter = filter;
			};

			$rootScope.showAdd = function() {
				$rootScope.item = {};
				$('#crud').modal();
			};

			$rootScope.editItem = function(item) {
				$rootScope.item = angular.copy(item);
				$('#crud').modal();
			};

			$rootScope.query = function() {
				Api($rootScope.table).query($rootScope.itemParams, function (result) {
					$rootScope.items = result;
					$('.modal').modal('hide');
				}, Notify.errorCallback);
			};

			$rootScope.addItem = function() {
				if(!$rootScope.item.status)	$rootScope.item.status = null;

				if(!$rootScope.item.id)		Api($rootScope.table).save($rootScope.item, successCallback, Notify.errorCallback);
				else						Api($rootScope.table).update({id: $rootScope.item.id}, $rootScope.item, successCallback, Notify.errorCallback);
			};

			$rootScope.deleteItem = function(id) {
				if (confirm("Are you sure you want to delete this item?"))
					Api($rootScope.table).delete({id: id}, successCallback, Notify.errorCallback);
			};

			$rootScope.restoreItem = function(item) {
				if (confirm("Are you sure you want to restore the item?")) {
					item.restore = 1;
					Api($rootScope.table).update({id: item.id}, item, successCallback, Notify.errorCallback);
				}
			};

			$rootScope.forceDeleteItem = function(id) {
				if (confirm("Are you sure you want to permanently remove this item?"))
					Api($rootScope.table).delete({id: id, force: 1}, successCallback, Notify.errorCallback);
			};

			$rootScope.get = function(table) {
				return Api(table).query({list: 1});
			};
		}
	])

	.controller('CampusCtrl', [
		'$rootScope',
		'$scope',
		'$location',
		function($rootScope, $scope, $location) {
			$rootScope.table = 'campuses';

			$scope.$watchCollection('itemParams', function (params) {
				$location.search(params);
				$rootScope.query();
			}, true);

		}
	])

	.controller('CandidateCtrl', [
		'$rootScope',
		'$scope',
		'$location',
		function($rootScope, $scope, $location) {
			$rootScope.table = 'candidates';

			$scope.$watchCollection('itemParams', function (params) {
				$location.search(params);
				$rootScope.query();
			}, true);

			$scope.positions = $rootScope.get('positions');
			$scope.party = $rootScope.get('party');
		}
	])

	.controller('CollegeCtrl', [
		'$rootScope',
		'$scope',
		'$location',
		function($rootScope, $scope, $location) {
			$rootScope.table = 'colleges';

			$scope.$watchCollection('itemParams', function (params) {
				$location.search(params);
				$rootScope.query();
			}, true);

		}
	])

	.controller('ElectionCtrl', [
		'$rootScope',
		'$scope',
		'Api',
		'Notify',
		function($rootScope, $scope, Api, Notify) {
			$scope.steps = 'finish';

			$scope.checkLogin = function() {
				Api('users').query({checklogin: 1, pass: $rootScope.item.password}, function (result) {
					$scope.steps = 'initialize';
				}, Notify.errorCallback);
			};

			$scope.goTo = function(where) {
				$scope.steps = where;
			};
		}
	])

	.controller('PartyCtrl', [
		'$rootScope',
		'$scope',
		'$location',
		function($rootScope, $scope, $location) {
			$rootScope.table = 'party';

			$scope.$watchCollection('itemParams', function (params) {
				$location.search(params);
				$rootScope.query();
			}, true);
		}
	])

	.controller('PositionCtrl', [
		'$rootScope',
		'$scope',
		'$location',
		function($rootScope, $scope, $location) {
			$rootScope.table = 'positions';

			$scope.$watchCollection('itemParams', function (params) {
				$location.search(params);
				$rootScope.query();
			}, true);

			$scope.colleges = $rootScope.get('colleges');
		}
	])

	.controller('SemesterCtrl', [
		'$rootScope',
		'$scope',
		'$location',
		function($rootScope, $scope, $location) {
			$rootScope.table = 'semesters';

			$scope.$watchCollection('itemParams', function (params) {
				$location.search(params);
				$rootScope.query();
			}, true);

		}
	])

	.controller('UserCtrl', [
		'$rootScope',
		'$scope',
		'$location',
		function($rootScope, $scope, $location) {
			$rootScope.table = 'users';

			$scope.$watchCollection('itemParams', function (params) {
				$location.search(params);
				$rootScope.query();
			}, true);

			$scope.roles = $rootScope.get('roles');

			$scope.editItem = function(item) {
				$rootScope.item = angular.copy(item);
				$.each($rootScope.item.roles, function(i, val) {
					$rootScope.item.roles[i] = val.id;
				});
				$('#crud').modal();
			};
		}
	])

	.controller('VoterCtrl', [
		'$rootScope',
		'$scope',
		'Api',
		'Notify',
		function($rootScope, $scope, Api, Notify) {
			$rootScope.table = 'voters';

			Api('voters').query({count: 1}, function(result) {
				$scope.count = result;
			}, Notify.errorCallback);

			$scope.generate = function() {
				$('#btn-generate').attr('disabled', true);
				// generate
				Api($rootScope.table).save({generate: 1}, function (result) {
					Notify.successCallback("Pass Codes generated successfully!");
					$('#btn-generate').attr('disabled', false);
				}, Notify.errorCallback);
			};

		}
	]);
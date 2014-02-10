angular.module('ssg', [
	'ngRoute'
])
	.config([
		'$httpProvider',
		'$routeProvider',
		'$locationProvider',
		function ($httpProvider, $routeProvider, $locationProvider) {
			
			$httpProvider.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";

			$locationProvider.html5Mode(true);

			$routeProvider
				.when('/admin', {
					templateUrl: '/ang/partials/admin/dashboard.html',
					reloadOnSearch: false
				})
				.when('/admin/manage/campuses', {
					templateUrl: '/ang/partials/admin/manage.campuses.html'
				})
				.when('/admin/manage/semesters', {
					templateUrl: '/ang/partials/admin/manage.semesters.html'
				});

			$routeProvider.when('/admin/404', {templateUrl: '/app/partials/404.html'});
			$routeProvider.otherwise({redirectTo: '/admin/404'});
		}
	]);
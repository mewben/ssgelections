angular.module('ssg')
	.directive('navMenu', [
		'$location',
		function ($location) {
			return function (scope, element, attrs) {

				var li,
					link,
					links,
					currentListItem,
					i,
					href,
					listItems = element.find('li'),
					urlMap = {};

				for (i = 0; i < listItems.length; i++) {

					li = angular.element(listItems[i]);
					links = li.find('a');
					if(links.length <= 0) continue;

					link = angular.element(links[0]);

					href = link.attr('href');

					urlMap[href] = li;
					urlMap[href]['icon'] = link.data('icon');
					urlMap[href]['title'] = link.data('title');
				}
				scope.urlMap = urlMap;

				scope.$on('$routeChangeStart', function() {
					var pathListItem = urlMap[$location.path()];
					if (pathListItem) {
						if (currentListItem) currentListItem.removeClass('active');

						currentListItem = pathListItem;
						currentListItem.addClass('active');
						scope.currentListItem = currentListItem;
					}
				});
			};
		}
	])

	.directive('navSubmenu', [
		'$location',
		function ($location) {
			return function (scope, element, attrs) {

				var li,
					link,
					links,
					currentListItem,
					i,
					href,
					listItems = element.find('li'),
					urlMap = {};

				for (i = 0; i < listItems.length; i++) {

					li = angular.element(listItems[i]);
					links = li.find('a');
					if(links.length <= 0) continue;

					link = angular.element(links[0]);

					href = link.attr('href');

					urlMap[href] = li;
					urlMap[href]['icon'] = link.data('icon');
					urlMap[href]['title'] = link.data('title');
				}
				scope.urlMap = urlMap;

				scope.$on('$routeChangeStart', function() {
					var pathListItem = urlMap[$location.path()];
					if (pathListItem) {
						if (currentListItem) currentListItem.removeClass('active');

						currentListItem = pathListItem;
						currentListItem.addClass('active');
						scope.currentListItem = currentListItem;
					}
				});
			};
		}
	]);
angular.module('ssg')
	.factory('Api', [
		'$resource',
		function ($resource) {

			return function(resource, resource2) {
				if (resource2)
					return $resource(
						'/api/v1/' + resource + '/:id/' + resource2 + '/:id2/',
						{id: '@id', id2: '@id2'},
						{
							'query' : { method: 'GET', isArray: false },
							'update': { method: 'PUT' }
						}
					);
				else
					return $resource(
						'/api/v1/' + resource + '/:id/',
						{id: '@id'},
						{
							'query' : { method: 'GET', isArray: false },
							'update': { method: 'PUT' }
						}
					);
			};
		}
	]);
(function() {
	'use strict';

	angular.module('Student')
		.service('StudentResource', ['$resource', 'Constants', function StudentResource($resource, Constants) {
			return $resource(Constants.api_url()+"students/:id/.json", {id: '@id'});
		}]);
})();


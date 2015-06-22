(function() {
	'use strict';

	angular.module('Cycle')
		.service('CycleResource', ['$resource', 'Constants', function CycleResource($resource, Constants) {
			return $resource(Constants.api_url()+'cycles/:id/.json', {id:'@id'}, {
				update: {method:'PUT'}
			});
		}]);
})();


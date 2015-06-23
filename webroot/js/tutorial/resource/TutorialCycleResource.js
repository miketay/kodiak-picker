(function() {
	'use strict';

	angular.module('Tutorial')
		.service('TutorialCycleResource', ['$resource', 'Constants', function TutorialCycleResource($resource, Constants) {
			return $resource(Constants.api_url()+"cycles/:cycle_id/tutorials/:tutorial_id/.json", {cycle_id:'@cycle_id', tutorial_id:'@tutorial_id'}, {
				update: {method:"PUT"}
			});
		}]);
})();


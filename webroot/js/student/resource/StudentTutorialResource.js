(function() {
	'use strict';

	angular.module('Student')
		.service('StudentTutorialResource', ['$resource', 'Constants', function StudentTutorialResource($resource, Constants) {
			return $resource(Constants.api_url()+"tutorials/:tutorial_id/students/:student_id/.json", {student_id:'@student_id', tutorial_id:'@tutorial_id'}, {
				register: {method:"POST"},
				unregister: {method:"DELETE"}
			});
		}]);
})();


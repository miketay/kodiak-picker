(function() {
	'use strict';

	angular.module('Tutorial')
		.service('TutorialStudentResource', ['$resource', 'Constants', function TutorialStudentResource($resource, Constants) {
			return $resource(Constants.api_url()+"students/:student_id/tutorials/:tutorial_id/.json", {student_id:'@student_id', tutorial_id:'@tutorial_id'}, {
				update: {method:"PUT"}
			});
		}]);
})();


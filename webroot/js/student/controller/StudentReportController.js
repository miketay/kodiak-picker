(function() {
	'use strict';

	angular.module('Student')
		.controller('StudentReportController', ['$scope', 'Page', 'StudentResource', function($scope, Page, StudentResource) {
			Page.title('Student Report');

			$scope.students = StudentResource.query({id:"active"});
		}]);
})();

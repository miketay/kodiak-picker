(function() {
	'use strict';

	angular.module('Student')
		.controller('StudentListController', ['$scope', '$location', 'Page', 'StudentResource', function($scope, $location, Page, StudentResource) {
			Page.title('Student List');

			$scope.students = StudentResource.query();

		}]);
})();


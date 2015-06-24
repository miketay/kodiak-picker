(function() {
	'use strict';

	angular.module('Student')
		.controller('StudentRegisterController', ['$scope', '$filter', '$mdDialog', 'StudentResource', function StudentRegisterController($scope, $filter, $mdDialog, StudentResource) {

			$scope.searchText = null;
			$scope.selStudents = [];
			$scope.selected = null;
			$scope.students = StudentResource.query();

			$scope.submit = function() {
				if (!$scope.register.$invalid) {
					$mdDialog.hide($scope.selStudents);
				}
			};

			$scope.querySearch = function(query) {
				// filter list
				var results = $filter('filter')($scope.students, query);
				return results;
			};
			
			$scope.cancel = function() {
				$mdDialog.cancel();
			};

			
		}]);
})();

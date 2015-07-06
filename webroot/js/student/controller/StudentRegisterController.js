(function() {
	'use strict';

	angular.module('Student')
		.controller('StudentRegisterController', ['$scope', '$filter', '$mdDialog', 'StudentResource', function StudentRegisterController($scope, $filter, $mdDialog, StudentResource) {

			$scope.searchText = null;
			$scope.selStudents = [];
			$scope.selected = [];
			$scope.students = StudentResource.query();

			$scope.submit = function() {
				if (!$scope.register.$invalid) {
					$mdDialog.hide($scope.selStudents);
				}
			};

			$scope.querySearch = function(query) {
				// filter list
				var results = $filter('filter')($scope.students, query);
				results = $filter('filter')(results, $scope.selected);
				return results;
			};
			
			$scope.cancel = function() {
				$mdDialog.cancel();
			};

			
		}]);
})();

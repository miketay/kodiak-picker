(function() {
	'use strict';

	angular.module('Student')
		.controller('StudentListController', ['$scope', '$location', '$mdDialog', 'Page', 'StudentResource', function($scope, $location, $mdDialog, Page, StudentResource) {
			Page.title('Student List');

			$scope.students = StudentResource.query();

			$scope.delete = function(index, ev) {
				var confirm = $mdDialog.confirm()
					.parent(angular.element(document.body))
					.title("Are you sure")
					.content("Delete "+$scope.students[index].first_name+"?")
					.ariaLabel("Confirmation")
					.ok("Delete")
					.cancel("Cancel")
					.targetEvent(ev);
				$mdDialog.show(confirm).then(function() {
					$scope.students[index].$delete(function() {
						$scope.students.splice(index, 1);
					});
				}, function() {
					// do nufin
				});
			};

		}]);
})();


(function() {
	'use strict';

	angular.module('Student')
		.controller('StudentListController', ['$scope', '$location', '$mdDialog', 'Page', 'StudentResource', function($scope, $location, $mdDialog, Page, StudentResource) {
			Page.title('Student List');

			$scope.students = StudentResource.query();

			$scope.deleting = false;

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
					$scope.deleting = true;
					$scope.students[index].$delete(function() {
						$scope.students.splice(index, 1);
						$scope.deleting = false;
					});
				}, function() {
					// do nufin
				});
			};

			$scope.delete8 = function(ev) {
				$scope.deleting = true;
				var delete8 = function(i) {
					if (i < 0) {
						$scope.deleting = false;
						if (!$scope.$$phase) {
							$scope.$digest();
						}
						return;
					}
					if ($scope.students[i].grade_level == 8) {
						$scope.students[i].$delete(function() {
							$scope.students.splice(i, 1);
							delete8(i-1);
						});
					} else {
						delete8(i-1);
					}
				};
				var i = $scope.students.length-1;
				var confirm = $mdDialog.confirm()
					.parent(angular.element(document.body))
					.title("Are you sure")
					.content("Delete all 8th graders?")
					.ariaLabel("Confirmation")
					.ok("Delete")
					.cancel("Cancel")
					.targetEvent(ev);
				$mdDialog.show(confirm).then(function() {
					var i = $scope.students.length-1;
					delete8(i);
				}, function() {
					$scope.deleting = false;
				});
			};

			$scope.deleteAll = function(ev) {
				$scope.deleting = true;
				var deleteAll = function(i) {
					if (i < 0) {
						$scope.deleting = false;
						if (!$scope.$$phase) {
							$scope.$digest();
						}
						return;
					}
					$scope.students[i].$delete(function() {
						$scope.students.splice(i, 1);
						deleteAll(i-1);
					});
				};
				var confirm = $mdDialog.confirm()
					.parent(angular.element(document.body))
					.title("Are you sure")
					.content("Delete all students?")
					.ariaLabel("Confirmation")
					.ok("Delete")
					.cancel("Cancel")
					.targetEvent(ev);
				$mdDialog.show(confirm).then(function() {
					var i = $scope.students.length-1;
					deleteAll(i);
				}, function() {
					$scope.deleting = false;
				});

			};

		}]);
})();


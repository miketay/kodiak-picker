(function() {
	'use strict';

	angular.module('Student')
		.controller('StudentReportController', ['$scope', 'Page', 'StudentResource', function($scope, Page, StudentResource) {
			Page.title('Student Report');

			$scope.students = StudentResource.query({id:"active"}, function() {
				for (var i=0; i<$scope.students.length; i++) {
					var student = $scope.students[i];
					if (student.tutorials.length) {
						student.tutorial = student.tutorials[0].name;
						student.instructor = student.tutorials[0].teacher_name;
						student.room = student.tutorials[0].room_number;
					}
				}
			});

			$scope.sort = ["full_name", "last_name"];
			$scope.reverse = false;

			$scope.newSort = function(type) {
				if ($scope.sort[0] == type) {
					$scope.reverse = !$scope.reverse;
				}
				$scope.sort = [type, "last_name"];
			};

			$scope.sortUp = function(type) {
				return $scope.sort[0] == type && $scope.reverse;
			};

			$scope.sortDown = function(type) {
				return $scope.sort[0] == type && !$scope.reverse;
			};
		}]);
})();

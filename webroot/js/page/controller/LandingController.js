(function() {
	'use strict';

	angular.module('Page')
		.controller('LandingController', ['$scope', '$filter', '$location', 'Page', 'StudentResource', 'StudentFactory', function LandingController($scope, $filter, $location, Page, StudentResource, StudentFactory) {
			Page.title("Kodiak - Login");
			
			$scope.students = StudentResource.query(function() {
				$scope.students.push({
					first_name:"admin",
				});
				$scope.students.push({
					first_name:"teacher",
				});
			});

			$scope.querySearch = function(query) {
				// filter list
				var results = $filter('filter')($scope.students, query);
				return results;
			};

			$scope.submit = function() {
				$scope.login.$setValidity('login', true);
				if ($scope.selected == null && $scope.searchText !== "admin") {
					$scope.login.name.$setValidity('required', false);
					return;
				}
				if ($scope.selected == null && $scope.searchText == "admin") {
					$scope.selected = {
						first_name: "admin"
					};
				}

				// query server for login
				StudentFactory.login($scope.selected, $scope.password).then(function(data) {
					// save current user to some singleton, go to appropriate page
					if (data.type == "admin" || data.type == "teacher") {
						$location.path("/admin/students");
					} else {
						$location.path("/tutorials");
					}
				}, function() {
					$scope.login.$setValidity('login', false);
				});
			};

		}]);
})();


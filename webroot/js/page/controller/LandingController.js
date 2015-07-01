(function() {
	'use strict';

	angular.module('Page')
		.controller('LandingController', ['$scope', '$filter', '$location', 'Page', 'StudentResource', 'StudentFactory', function LandingController($scope, $filter, $location, Page, StudentResource, StudentFactory) {
			Page.title("Kodiak - Login");
			
			$scope.students = StudentResource.query();

			$scope.querySearch = function(query) {
				// filter list
				var results = $filter('filter')($scope.students, query);
				return results;
			};

			$scope.submit = function() {
				$scope.login.$setValidity('login', true);
				if ($scope.selected == null) {
					$scope.login.name.$setValidity('required', false);
					return;
				}

				// query server for login
				StudentFactory.login($scope.selected, $scope.password).then(function(data) {
					// save current user to some singleton, go to appropriate page
					if (data.type == "admin") {
						$location.path("/admin");
					} else {
						$location.path("/tutorials");
					}
				}, function() {
					$scope.login.$setValidity('login', false);
				});
			};

		}]);
})();


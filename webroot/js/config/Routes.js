(function() {
	'use strict';

	angular.module('Config')
		.factory('Routes', [function RoutesFactory() {
			var routes = {
				"/": {
					templateUrl: "/js/page/view/landing.html",
					controller: "LandingController",
					requiredLogin: 0
				},
				"/import": {
					templateUrl: "/js/student/view/import.html",
					controller: "StudentImportController",
					requiredLogin: 0 // TODO: change when authentication is implemented
				},
				"/cycles": {
					templateUrl: "/js/cycle/view/index.html",
					controller: "CycleListController",
					requiredLogin: 0 // TODO: change when authentication is implemented
				}
			};

			return {
				routes: function() { return routes; }
			};
		}]);
})();


(function() {
	'use strict';

	angular.module('Config')
		.factory('Routes', [function RoutesFactory() {
			var routes = {
				"/": {
					templateUrl: "/js/page/view/landing.html",
					controller: "LandingController",
					requiredLogin: "none"
				},
				"/tutorials": {
					templateUrl: "/js/tutorials/view/index.html",
					controller: "TutorialListController",
					requiredLogin: "student"
				},
				"/logout": {
					templateUrl: "/js/page/view/landing.html",
					controller: "LogoutController",
					requiredLogin: "student"
				},
				"/admin/import": {
					templateUrl: "/js/student/view/import.html",
					controller: "StudentImportController",
					requiredLogin: "admin" 
				},
				"/admin/cycles": {
					templateUrl: "/js/cycle/view/index.html",
					controller: "CycleListController",
					requiredLogin: "admin" 
				},
				"/admin/cycles/:id": {
					templateUrl: "/js/cycle/view/detail.html",
					controller: "CycleDetailController",
					requiredLogin: "admin" 
				},
				"/admin/cycles/:cycle_id/tutorials/:tutorial_id": {
					templateUrl: "/js/tutorial/view/detail.html",
					controller: "TutorialDetailController",
					requiredLogin: "admin" 
				}
			};

			return {
				routes: function() { return routes; }
			};
		}]);
})();


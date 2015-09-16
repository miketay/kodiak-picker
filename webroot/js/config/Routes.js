(function() {
	'use strict';

	angular.module('Config')
		.factory('Routes', [function RoutesFactory() {
			var routes = {
				"/": {
					templateUrl: "/js/page/view/landing.html",
					controller: "LandingController",
					requiredLogin: ["none"]
				},
				"/tutorials": {
					templateUrl: "/js/tutorial/view/index.html",
					controller: "TutorialListController",
					requiredLogin: ["student"]
				},
				"/logout": {
					templateUrl: "/js/page/view/landing.html",
					controller: "LogoutController",
					requiredLogin: ["student"]
				},
				"/admin/import": {
					templateUrl: "/js/student/view/import.html",
					controller: "StudentImportController",
					requiredLogin: ["admin", "teacher"] 
				},
				"/admin/students": {
					templateUrl: "/js/student/view/list.html",
					controller: "StudentListController",
					requiredLogin: ["admin", "teacher"]
				},
				"/admin/student-report": {
					templateUrl: "/js/student/view/report.html",
					controller: "StudentReportController",
					requiredLogin: ["admin", "teacher"]
				},
				"/admin/cycles": {
					templateUrl: "/js/cycle/view/index.html",
					controller: "CycleListController",
					requiredLogin: ["admin", "teacher"] 
				},
				"/admin/cycles/:id": {
					templateUrl: "/js/cycle/view/detail.html",
					controller: "CycleDetailController",
					requiredLogin: ["admin", "teacher"] 
				},
				"/admin/cycles/:cycle_id/tutorials/:tutorial_id": {
					templateUrl: "/js/tutorial/view/detail.html",
					controller: "TutorialDetailController",
					requiredLogin: ["admin", "teacher"] 
				},
				"/admin/logout": {
					templateUrl: "/js/page/view/landing.html",
					controller: "LogoutController",
					requiredLogin: ["admin", "teacher"]
				}
			};

			return {
				routes: function() { return routes; }
			};
		}]);
})();


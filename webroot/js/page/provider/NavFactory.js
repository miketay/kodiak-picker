(function() {
	'use strict';

	angular.module('Page')
		.factory('Nav', ['$location', 'StudentFactory', function NavFactory($location, StudentFactory) {
			var navigationItems = {
				"none": [
				{
					"icon": "home",
					"text": "Home",
					"url": "/"
				}],
				"student":[
				{
					"icon": "logout",
					"text": "Logout",
					"url": "/logout"
				}],
                "teacher":[
				{
					"icon": "students",
					"text": "Students",
					"url": "/admin/students"
				},
				{
					"icon": "report",
					"text": "Student Report",
					"url": "/admin/student-report"
				},
				{
					"icon": "cycle",
					"text": "Cycles",
					"url": "/admin/cycles"
				},
				{
					"icon": "logout",
					"text": "Logout",
					"url": "/admin/logout"
				}],
                "admin":[
				{
					"icon": "import",
					"text": "Import Students",
					"url": "/admin/import"
				},
				{
					"icon": "students",
					"text": "Students",
					"url": "/admin/students"
				},
				{
					"icon": "report",
					"text": "Student Report",
					"url": "/admin/student-report"
				},
				{
					"icon": "cycle",
					"text": "Cycles",
					"url": "/admin/cycles"
				},
				{
					"icon": "logout",
					"text": "Logout",
					"url": "/admin/logout"
				}]
			};

			var which = function() {
				return StudentFactory.type();
			};

			var nav = {
				"items": function() {
					return navigationItems[which()];
				},
				"select": function(item) {
					$location.path(item.url);
				},
				"selected": function(item) {
					return $location.path() == item.url;
				}
			};

			return nav;
		}]);
})();


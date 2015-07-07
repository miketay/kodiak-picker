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
					"icon": "home",
					"text": "Home",
					"url": "/"
				},
				{
					"icon": "",
					"text": "Logout",
					"url": "/logout"
				}],
                "admin":[
				{
					"icon": "",
					"text": "Import Students",
					"url": "/admin/import"
				},
				{
					"icon": "",
					"text": "Students",
					"url": "/admin/students"
				},
				{
					"icon": "",
					"text": "Cycles",
					"url": "/admin/cycles"
				},
				{
					"icon": "",
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


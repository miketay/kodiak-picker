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
				}],
                "admin":[
				{
					"icon": "",
					"text": "Admin",
					"url": "/admin"
				},
				{
					"icon": "",
					"text": "Import Students",
					"url": "/import"
				},
				{
					"icon": "",
					"text": "Cycles",
					"url": "/cycles"
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


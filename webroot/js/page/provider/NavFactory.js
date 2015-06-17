(function() {
	'use strict';

	angular.module('Page')
		.factory('Nav', ['$location', 'Auth', function NavFactory($location, Auth) {
			var navigationItems = [
				[ // student
					{
						"icon": "",
						"text": "Home",
						"url": "/",
					},
				],
                [ // admin
                    {
                        "icon": "",
                        "text": "Admin",
                        "url": "/admin",
                    }
                ]
			];

			var which = function() {
				return Auth.userType();
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


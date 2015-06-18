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
				"/sign-in": {
					templateUrl: "/js/auth/view/auth.html",
					controller: "AuthController",
					requiredLogin: 0
				},
				"/logout": {
					templateUrl: "/js/auth/view/auth.html",
					controller: "AuthController",
					requiredLogin: 1
				},
				"/users": {
					templateUrl: "/js/users/view/index.html",
					controller: "UserListController",
					requiredLogin: 0
				},
				"/users/:id": {
					templateUrl: "/js/users/view/user.html",
					controller: "UserDetailController",
					requiredLogin: 0
				},
			};

			return {
				routes: function() { return routes; }
			};
		}]);
})();


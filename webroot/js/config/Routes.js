(function() {
	'use strict';

	angular.module('Config')
		.factory('Routes', [function RoutesFactory() {
			var routes = {
				"/": {
					templateUrl: "./src/page/view/landing.html",
					controller: "LandingController",
					requiredLogin: 0
				},
				"/sign-in": {
					templateUrl: "./src/auth/view/auth.html",
					controller: "AuthController",
					requiredLogin: 0
				},
				"/logout": {
					templateUrl: "./src/auth/view/auth.html",
					controller: "AuthController",
					requiredLogin: 1
				},
				"/users": {
					templateUrl: "./src/users/view/index.html",
					controller: "UserListController",
					requiredLogin: 0
				},
				"/users/:id": {
					templateUrl: "./src/users/view/user.html",
					controller: "UserDetailController",
					requiredLogin: 0
				},
			};

			return {
				routes: function() { return routes; }
			};
		}]);
})();


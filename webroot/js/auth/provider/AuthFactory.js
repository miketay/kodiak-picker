(function() {
	'use strict';

	angular.module('Auth')
		.factory('Auth', ['$http', '$q', 'Constants', function AuthFactory($http, $q, Constants) {
			var user = {};
			var redirect = false;

			var auth = {
				user: function() {
					return user;
				},
				isLoggedIn: function() {
					return !!token;
				},
				userType: function() {
					if (typeof user.type !== "undefined") {
						return user.type;
					}
					return 0;
				}
			};

			return auth;
		}]);
})();


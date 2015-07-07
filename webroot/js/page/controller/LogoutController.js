(function() {
	'use strict';

	angular.module('Page')
		.controller('LogoutController', ['$location', 'StudentFactory', function($location, StudentFactory) {
			StudentFactory.logout();
			$location.path("/");
		}]);
})();


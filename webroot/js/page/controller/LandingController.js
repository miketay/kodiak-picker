(function() {
	'use strict';

	angular.module('Page')
		.controller('LandingController', ['$scope', 'Page', function LandingController($scope, Page) {
			Page.title("Kodiak");

		}]);
})();


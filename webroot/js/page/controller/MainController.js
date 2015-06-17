(function() {
	'use strict';

	angular.module('Page')
		.controller('MainController', ['$scope', '$mdSidenav', 'Page', 'Nav', function MainController($scope, $mdSidenav, Page, Nav) {
			$scope.page = Page;
			$scope.nav = Nav;

			$scope.toggleSidenav = function(which) {
				$mdSidenav(which).toggle();
			};

			$scope.select = function(it) {
				$scope.nav.select(it);
				$mdSidenav('left').toggle();
			};
		}]);
})();


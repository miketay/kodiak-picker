(function() {
	'use strict';

	angular.module('Page')
		.controller('MainController', ['$scope', '$mdSidenav', 'StudentFactory', 'Page', 'Nav', function MainController($scope, $mdSidenav, StudentFactory, Page, Nav) {
			$scope.page = Page;
			$scope.nav = Nav;

			$scope.admin = function() {
				return StudentFactory.type() === "admin";
			};

			$scope.toggleSidenav = function(which) {
				$mdSidenav(which).toggle();
			};

			$scope.select = function(it) {
				$scope.nav.select(it);
				$mdSidenav('left').toggle();
			};
		}]);
})();


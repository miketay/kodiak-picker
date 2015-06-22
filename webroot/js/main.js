(function() {
	'use strict';

	angular.module('kodiak', ['ngMaterial','ngRoute','ngResource','ngMessages','Config','Auth','Page'])
		.config(['$mdThemingProvider', '$mdIconProvider', '$routeProvider', '$locationProvider', '$resourceProvider', 'RoutesProvider', function($mdThemingProvider, $mdIconProvider, $routeProvider, $locationProvider, $resourceProvider, RoutesProvider) {
			var routes = RoutesProvider.$get().routes();
			for (var path in routes) {
				$routeProvider.when(path, routes[path]);
			}
			$routeProvider.otherwise({
				templateUrl: '/js/page/view/404.html',
				controller: 'NotFoundController'
			});

			$locationProvider.html5Mode(true);

			$mdIconProvider
				.icon("menu",	"/assets/svg/menu.svg",	24)
				.icon("home",	"/assets/svg/home.svg", 24)
				.icon("add",	"/assets/svg/add.svg",	24)
				.icon("share",	"/assets/svg/share.svg",24)
				.icon("close",	"/assets/svg/close.svg",24)
				.icon("create",	"/assets/svg/create.svg",24);
			
			$resourceProvider.defaults.stripTrailingSlashes = false;
		}])
		.run(['$rootScope', '$location', '$mdToast', 'Routes', function($rootScope, $location, $mdToast, Routes) {
			// this is where you add auth stuff
		}]);
})();


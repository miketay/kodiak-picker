(function() {
	'use strict';

	angular.module('kodiak', ['ngMaterial','ngRoute','ngResource','ngMessages','Config','Page'])
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
				.icon("lock",   "/assets/svg/lock.svg", 24)
				.icon("logout", "/assets/svg/logout.svg",24)
				.icon("cycle",	"/assets/svg/cycle.svg"	,24)
				.icon("import",	"/assets/svg/import.svg",24)
				.icon("report",	"/assets/svg/report.svg",24)
				.icon("students","/assets/svg/students.svg",24)
				.icon("up",		"/assets/svg/up.svg"	,24)
				.icon("down",	"/assets/svg/down.svg"	,24)
				.icon("create",	"/assets/svg/create.svg",24);
			
			$resourceProvider.defaults.stripTrailingSlashes = false;
		}])
		.run(['$rootScope', '$location', '$mdToast', 'Routes', 'StudentFactory', function($rootScope, $location, $mdToast, Routes, StudentFactory) {
			$rootScope.$on('$locationChangeStart', function(event, next, current) {
				var signin = function() {
					event.preventDefault();
					$location.path("/");
					$mdToast.show(
							$mdToast.simple()
								.content("You must sign in to access this page!")
								.position("top right")
					);
				};
				next = next.replace($location.protocol()+"://"+$location.host(), "");
				// if they aren't signed in at all, they can only be on the root
				if (next != "/" && StudentFactory.type() == "none") {
					signin();
					return;
				}
				// check proper permissions for each page
				var routes = Routes.routes();
				var type = StudentFactory.type();
				for (var i in routes) {
					if (next == i && (routes[i].requiredLogin.indexOf(type) === false)) {
						signin();
						return;
					}
				}
			});
		}]);
})();


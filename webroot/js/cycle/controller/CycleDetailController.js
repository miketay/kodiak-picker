(function() {
	'use strict';

	angular.module('Cycle')
		.controller('CycleDetailController', ['$scope', '$mdDialog', '$location', 'Page', function CycleDetailController($scope, $mdDialog, $location, Page) {
			Page.title('Cool Title');
		}]);
})();


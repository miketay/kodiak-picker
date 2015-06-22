(function() {
	'use strict';

	angular.module('Cycle')
		.controller('CycleListController', ['$scope', 'Page', 'CycleResource', function($scope, Page, CycleResource) {
			Page.title('Cycles');
			$scope.cycles = CycleResource.query();
		}]);
})();


(function() {
	'use strict';

	angular.module('Student')
		.controller('StudentImportController', ['$scope', 'Page', function($scope, Page) {
			Page.title("Import Students");
		}]);
})();


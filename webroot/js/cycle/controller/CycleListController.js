(function() {
	'use strict';

	angular.module('Cycle')
		.controller('CycleListController', ['$scope', '$mdDialog', 'Page', 'CycleResource', function($scope, $mdDialog, Page, CycleResource) {
			Page.title('Cycles');
			$scope.cycles = CycleResource.query();

			$scope.create = function(ev) {
				$mdDialog.show({
					controller: 'CycleCreateController',
					templateUrl: '/js/cycle/view/create-dialog.html',
					parent: angular.element(document.body),
					targetEvent: ev
				}).then(function(data) {
					// create new cycle
					var newCycle = new CycleResource();
					angular.extend(newCycle, data);
					newCycle.$save();
					$scope.cycles.push(newCycle);
				});
			};
		}]);
})();


(function() {
	'use strict';

	angular.module('Cycle')
		.controller('CycleListController', ['$scope', '$location', '$mdDialog', 'Page', 'CycleResource', function($scope, $location, $mdDialog, Page, CycleResource) {
			Page.title('Cycles');
			$scope.cycles = CycleResource.query();

			var find = function(id) {
				for (var i=0; i<$scope.cycles.length; i++) {
					if ($scope.cycles[i].id == id) {
						return i;
					}
				}
				return false;
			};

			$scope.create = function(ev) {
				$mdDialog.show({
					controller: 'CycleCreateController',
					templateUrl: '/js/cycle/view/create-dialog.html',
					parent: angular.element(document.body),
					targetEvent: ev,
					locals: {
						cycle: false
					}
				}).then(function(data) {
					// create new cycle
					var newCycle = new CycleResource();
					angular.extend(newCycle, data);
					newCycle.$save(function() {
						$scope.cycles.push(newCycle);
					});
				});
			};

			$scope.navigate = function(id) {
				$location.path("/admin/cycles/"+id);
			};

			$scope.edit = function(id, ev) {
				var i = find(id);
				$mdDialog.show({
					controller: 'CycleCreateController',
					templateUrl: '/js/cycle/view/create-dialog.html',
					parent: angular.element(document.body),
					targetEvent: ev,
					locals: {
						cycle: $scope.cycles[i]
					}
				}).then(function(data) {
					if (data == "delete") {
						$scope.cycles[i].$delete();
						$scope.cycles.splice(i, 1);
					} else {
						angular.extend($scope.cycles[i], data);
						$scope.cycles[i].$update();
					}
				});
			};
		}]);
})();


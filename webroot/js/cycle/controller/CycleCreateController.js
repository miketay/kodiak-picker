(function() {
	'use strict';

	angular.module('Cycle')
		.controller('CycleCreateController', ['$scope', '$mdDialog', '$document', 'cycle', function CycleCreateController($scope, $mdDialog, $document, cycle) {

			$scope.edit = false; 
			if (cycle !== false) {
				$scope.cycle = cycle;
				$scope.edit = true;
			} else {
				$scope.cycle = {
					name: "",
					status: "Pre-registration"
				};
			}

			$scope.title = function() {
				if ($scope.edit) {
					return "Edit "+$scope.cycle.name;
				}
				return "Create New Cycle";
			};

			$scope.button = function() {
				if ($scope.edit) {
					return "Save";
				}
				return "Create";
			};

			$scope.submit = function() {
				if (!$scope.create.$error) {
					$mdDialog.hide($scope.cycle);
				} else {
					$document[0].create.name.focus();
				}
			};
			
			$scope.delete = function() {
				$mdDialog.hide("delete");
			};

			$scope.cancel = function() {
				$mdDialog.cancel();
			};
		}]);
})();

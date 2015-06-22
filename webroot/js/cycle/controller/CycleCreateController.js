(function() {
	'use strict';

	angular.module('Cycle')
		.controller('CycleCreateController', ['$scope', '$mdDialog', '$document', function CycleCreateController($scope, $mdDialog, $document) {
			$scope.cycle = {
				name: "",
				status: "Pre-registration"
			};

			$scope.submit = function() {
				if (!$scope.create.$error) {
					$mdDialog.hide($scope.cycle);
				} else {
					$document[0].create.name.focus();
				}
			};
			$scope.cancel = function() {
				$mdDialog.cancel();
			};
		}]);
})();

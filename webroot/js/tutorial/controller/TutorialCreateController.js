(function() {
	'use strict';

	angular.module('Tutorial')
		.controller('TutorialCreateController', ['$scope', '$mdDialog', '$document', 'tutorial', function TutorialCreateController($scope, $mdDialog, $document, tutorial) {

			$scope.edit = false; 
			if (tutorial !== false) {
				$scope.tutorial = tutorial;
				$scope.edit = true;
			} else {
				$scope.tutorial = {
					name: "",
					teacher_name: "",
					room_number: 0,
					max_students: 10
				};
			}

			$scope.title = function() {
				if ($scope.edit) {
					return "Edit "+$scope.tutorial.name;
				}
				return "Create New Tutorial";
			};

			$scope.button = function() {
				if ($scope.edit) {
					return "Save";
				}
				return "Create";
			};

			$scope.submit = function() {
				if (!$scope.create.$invalid) {
					$mdDialog.hide($scope.tutorial);
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

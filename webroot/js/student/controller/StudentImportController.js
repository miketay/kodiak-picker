(function() {
	'use strict';

	angular.module('Student')
		.controller('StudentImportController', ['$scope', '$location', 'Page', 'StudentFactory', function StudentImportController($scope, $location, Page, StudentFactory) {
			Page.title("Import Students");
			$scope.filetypes = ['text/plain'];
			$scope.serverError = "";
			$scope.importing = false;

			var updateUI = function() {
				if (!$scope.$$phase) {
					$scope.$digest();
				}
			};

			$scope.upload = function(files) {
				$scope.uploadForm.files.$setValidity('fileType', true);
				$scope.uploadForm.files.$setValidity('serverError', true);
				var file = files[0]; // we only allow one file
				if (file.type != "text/plain") {
					$scope.uploadForm.files.$setValidity('fileType', false);
				} else {
					// upload 
					$scope.importing = true;
					StudentFactory.upload(file).then(function success(data) {
						console.log("successfully imported student list");
						$scope.importing = false;
						$location.path("/admin/students");
					}, function error(data) {
						$scope.serverError = data.message;
						$scope.uploadForm.files.$setValidity('serverError', false);
						$scope.importing = false;
					});
				}
				updateUI();
			};
		}]);
})();


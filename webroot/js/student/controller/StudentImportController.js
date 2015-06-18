(function() {
	'use strict';

	angular.module('Student')
		.controller('StudentImportController', ['$scope', 'Page', 'StudentFactory', function StudentImportController($scope, Page, StudentFactory) {
			Page.title("Import Students");
			$scope.filetypes = ['text/plain'];

			$scope.upload = function(files) {
				$scope.uploadForm.files.$setValidity('fileType', true);
				var file = files[0]; // we only allow one file
				if (file.type != "text/plain") {
					$scope.uploadForm.files.$setValidity('fileType', false);
				} else {
					// upload 
					StudentFactory.upload(file).then(function success(data) {
						console.log("successfully imported student list");
						// redirect to student list
					}, function error(data) {
						console.log(data);
						// do something based on error
					});
				}
				if (!$scope.$$phase) {
					$scope.$digest();
				}
			};
		}]);
})();


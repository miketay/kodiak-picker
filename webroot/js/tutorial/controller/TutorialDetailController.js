(function() {
	'use strict';

	angular.module('Tutorial')
		.controller('TutorialDetailController', ['$scope', '$mdDialog', '$location', '$routeParams', 'Page', 'TutorialCycleResource', 'StudentTutorialResource', function TutorialDetailController($scope, $mdDialog, $location, $routeParams, Page, TutorialCycleResource, StudentTutorialResource) {
			$scope.message = "Loading...";
			$scope.students = StudentTutorialResource.query({
				tutorial_id: $routeParams.tutorial_id
			}, function() {
				$scope.message = "There are no students registered for this tutorial yet";
			});
			$scope.tutorial = TutorialCycleResource.get({
				cycle_id: $routeParams.cycle_id,
				tutorial_id: $routeParams.tutorial_id
			}, function() {
				Page.title($scope.tutorial.name+" Students");
			});

			$scope.navigate = function(id) {
				$location.path("/students/"+id);
			};

			$scope.add = function(ev) {
				$mdDialog.show({
					controller: 'StudentRegisterController',
					templateUrl: '/js/student/view/register-dialog.html',
					parent: angular.element(document.body),
					targetEvent: ev
				}).then(function(data) {
					// register student w/ lock
				});
			};


		}]);
})();


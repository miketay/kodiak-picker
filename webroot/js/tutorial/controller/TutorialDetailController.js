(function() {
	'use strict';

	angular.module('Tutorial')
		.controller('TutorialDetailController', ['$scope', '$mdDialog', '$location', '$routeParams', 'Page', 'TutorialCycleResource', 'StudentTutorialResource', function TutorialDetailController($scope, $mdDialog, $location, $routeParams, Page, TutorialCycleResource, StudentTutorialResource) {
			var getStudents = function() {
				$scope.message = "Loading...";
				$scope.students = StudentTutorialResource.query({
					tutorial_id: $routeParams.tutorial_id
				}, function() {
					$scope.message = "There are no students registered for this tutorial yet";
				});
			};
			getStudents();

			$scope.tutorial = TutorialCycleResource.get({
				cycle_id: $routeParams.cycle_id,
				tutorial_id: $routeParams.tutorial_id
			}, function() {
				Page.title($scope.tutorial.name+" Students");
			});

			$scope.navigate = function(id) {
				$location.path("/admin/students/"+id);
			};

			$scope.add = function(ev) {
				$mdDialog.show({
					controller: 'StudentRegisterController',
					templateUrl: '/js/student/view/register-dialog.html',
					parent: angular.element(document.body),
					targetEvent: ev,
					locals: {
						students: $scope.students
					},
					bindToController: true
				}).then(function(data) {
					// register student w/ lock
					var i = 0;
					var register = function() {
						var reg = {
							tutorial_id: $routeParams.tutorial_id,
							student_id: data[i].id
						};
						StudentTutorialResource.register(reg, function() {
							i++;
							if (i == data.length) {
								getStudents();
							} else {
								register();
							}
						});
					};
					register();
				});
			};

			$scope.remove = function(student_id) {
				var newReg = new StudentTutorialResource();
				newReg.$unregister({tutorial_id: $routeParams.tutorial_id, student_id: student_id}, function() {
					getStudents();
				});
			};


		}]);
})();


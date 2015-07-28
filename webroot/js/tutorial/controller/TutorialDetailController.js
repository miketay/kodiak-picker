(function() {
	'use strict';

	angular.module('Tutorial')
		.controller('TutorialDetailController', ['$scope', '$mdDialog', '$mdToast', '$routeParams', 'Page', 'TutorialCycleResource', 'StudentTutorialResource', function TutorialDetailController($scope, $mdDialog, $mdToast, $routeParams, Page, TutorialCycleResource, StudentTutorialResource) {
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
						var reg = new StudentTutorialResource();
						reg.lock = true;
						reg.$register({tutorial_id: $routeParams.tutorial_id,student_id: data[i].id}, function() {
							i++;
							if (i == data.length) {
								getStudents();
							} else {
								getStudents();
								register();
							}
						}, function(data) {
							// error handler?
							if (data.data.message == "full") {
								$mdToast.show($mdToast.simple()
									.content("This Tutorial is Full!")
									.position("top right")
								);
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


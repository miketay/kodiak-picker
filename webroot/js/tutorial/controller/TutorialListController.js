(function() {
	'use strict';

	angular.module('Tutorial')
		.controller('TutorialListController', ['$scope', '$mdDialog', 'Page', 'TutorialCycleResource', 'StudentTutorialResource', 'StudentFactory', function($scope, $mdDialog, Page, TutorialCycleResource, StudentTutorialResource, StudentFactory) {
			Page.title("Tutorials");

			var tutorials = TutorialCycleResource.query({cycle_id:0});
			$scope.user = StudentFactory.user();
			$scope.tutorial = {
				"active": [],
				"open": []
			};
			if (!!$scope.user.tutorials.length) {
				// find active and open tutorials
				for (var i=0; i<$scope.user.tutorials.length; i++) {
					var tutorial = $scope.user.tutorials[i];
					if (tutorial['cycle']['status'] == "Open") {
						$scope.tutorial['open'] = $scope.user.tutorials[i];
					} else if (tutorial['cycle']['status'] == "Active") {
						$scope.tutorial['active'] = $scope.user.tutorials[i];
					}
				}
			}

			var find = function(id) {
				for (var i=0; i<tutorials.length; i++) {
					if (tutorials[i].id == id) {
						return tutorials[i];
					}
				}
				return false;
			};

			$scope.list = function() {
				var result = [];
				for (var i=0; i<tutorials.length; i++) {
					if (tutorials[i].id != $scope.tutorial.id && tutorials[i].students.length <= tutorials[i].max_students) {
						result.push(tutorials[i]);
					}
				}
				return result;
			};

			$scope.select = function(id, ev) {
				var tut = find(id);
				var conf = $mdDialog.confirm()
					.parent(angular.element(document.body))
					.title("Are you sure?")
					.content("Register for "+tut.name+"?")
					.ok("Yes")
					.cancel("Cancel")
					.targetEvent(ev);
				$mdDialog.show(conf).then(function() {
					StudentTutorialResource.register({student_id:StudentFactory.userId(), tutorial_id:id}, function(data) {
						$scope.tutorial['open'] = tut;
					});
				}, function() {
					// do nothing
				});
			};

			$scope.registered = function(type) {
				return !!$scope.tutorial[type].id;
			};

			$scope.locked = function(type) {
				if (!!$scope.tutorial[type].id) {
					return !!$scope.tutorial[type]._joinData.locked;
				}
				return false;
			};

		}]);
})();


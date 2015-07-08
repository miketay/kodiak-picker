(function() {
	'use strict';

	angular.module('Tutorial')
		.controller('TutorialListController', ['$scope', '$mdDialog', 'Page', 'TutorialCycleResource', 'StudentTutorialResource', 'StudentFactory', function($scope, $mdDialog, Page, TutorialCycleResource, StudentTutorialResource, StudentFactory) {
			Page.title("Tutorials");

			var tutorials = TutorialCycleResource.query({cycle_id:0});
			$scope.user = StudentFactory.user();
			$scope.tutorial = [];
			if (!!$scope.user.tutorials.length) {
				$scope.tutorial = $scope.user.tutorials[0];
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
					if (tutorials[i].id != $scope.tutorial.id) {
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
						$scope.tutorial = data.tutorials[0];
					});
				}, function() {
					// do nothing
				});
			};

			$scope.registered = function() {
				return !!$scope.tutorial.id;
			};

			$scope.locked = function() {
				if (!!$scope.tutorial.id) {
					return !!$scope.tutorial._joinData.locked;
				}
				return false;
			};

		}]);
})();


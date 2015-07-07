(function() {
	'use strict';

	angular.module('Tutorial')
		.controller('TutorialListController', ['$scope', 'Page', 'TutorialCycleResource', 'StudentTutorialResource', 'StudentFactory', function($scope, Page, TutorialCycleResource, StudentTutorialResource, StudentFactory) {
			Page.title("Tutorials");

			$scope.tutorials = TutorialCycleResource.query({cycle_id:0});
			$scope.user = StudentFactory.user();
			$scope.tutorial = false;
			if (!!$scope.user.tutorials) {
				$scope.tutorial = $scope.user.tutorials[0];
			}

			$scope.list = function() {
				// filter tutorials
			};

			$scope.select = function(id) {
				StudentTutorialResource.register({student_id:StudentFactory.userId(), tutorial_id:id}, function() {
					console.log('done');
				});
			};

			$scope.registered = function() {
				return !!$scope.tutorial;
			};

			$scope.locked = function() {
				if (!!$scope.tutorial) {
					return !!$scope.tutorial._joinData.locked;
				}
				return false;
			};

		}]);
})();


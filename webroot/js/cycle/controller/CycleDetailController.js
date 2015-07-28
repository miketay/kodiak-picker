(function() {
	'use strict';

	angular.module('Cycle')
		.controller('CycleDetailController', ['$scope', '$mdDialog', '$location', '$routeParams', 'Page', 'CycleResource', 'TutorialCycleResource', function CycleDetailController($scope, $mdDialog, $location, $routeParams, Page, CycleResource, TutorialCycleResource) {
			$scope.message = "Loading...";
			$scope.tutorials = TutorialCycleResource.query({cycle_id:$routeParams.id}, function() {
				$scope.message = "No tutorials added yet"
			});

			$scope.cycle = CycleResource.get({id:$routeParams.id}, function() {
				Page.title($scope.cycle.name+" Tutorials");
			});

			var find = function(id) {
				for (var i=0; i<$scope.tutorials.length; i++) {
					if ($scope.tutorials[i].id == id) {
						return i;
					}
				}
				return false;
			};

			$scope.create = function(ev) {
				$mdDialog.show({
					controller: 'TutorialCreateController',
					templateUrl: '/js/tutorial/view/create-dialog.html',
					parent: angular.element(document.body),
					targetEvent: ev,
					locals: {
						tutorial: false
					}
				}).then(function(data) {
					// create new tutorial
					var newTutorial = new TutorialCycleResource();
					angular.extend(newTutorial, data);
					newTutorial.cycle_id = $routeParams.id;
					newTutorial.$save(function() {
						$scope.tutorials.push(newTutorial);
					});
				});
			};

			$scope.navigate = function(id) {
				$location.path("/admin/cycles/"+$scope.cycle.id+"/tutorials/"+id);
			};

			$scope.edit = function(id, ev) {
				var i = find(id);
				$mdDialog.show({
					controller: 'TutorialCreateController',
					templateUrl: '/js/tutorial/view/create-dialog.html',
					parent: angular.element(document.body),
					targetEvent: ev,
					locals: {
						tutorial: $scope.tutorials[i]
					}
				}).then(function(data) {
					if (data == "delete") {
						$scope.tutorials[i].$delete();
						$scope.tutorials.splice(i, 1);
					} else {
						angular.extend($scope.tutorials[i], data);
						$scope.tutorials[i].$update({tutorial_id:data.id});
					}
				});
			};
		}]);
})();


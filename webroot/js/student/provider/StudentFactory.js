(function() {
	'use strict';

	angular.module('Student')
		.factory('StudentFactory', ['$http', '$q', 'Constants', function StudentFactory($http, $q, Constants) {
			var currentUser = {};
			return {
				upload: function(file) {
					var defer = $q.defer();
					var formData = new FormData();
					formData.append('list', file, file.name);
					
					$http.post(Constants.api_url()+"students/import.json", formData).success(function(data) {
						defer.resolve(data);
					}).error(function(data, status) {
						if (data === null) {
							data = {};
						}
						if (typeof data === "object") {
							data.status = status;
						}
						defer.reject(data);
					});

					return defer.promise;
				},
				login: function(student, password) {
					var defer = $q.defer();
					var data = {student: student, password: password};
					$http.post(Constants.api_url()+"students/login.json", data).success(function(data) {
						angular.extend(currentUser, data);
						defer.resolve(currentUser);
					}).error(function(data, status) {
						defer.reject(data);
					});

					return defer.promise;
				},
				register: function(tutorial_id) {
					var defer = $q.defer();
					$http.post(Constants.api_url()+"tutorials/"+tutorial_id+"/students/"+currentUser.id, {}).success(function(data) {
						// do something with this registration
						defer.resolve(data);
					}).error(function(data, status) {
						defer.reject(data);
					});
					return defer.promise;
				},
				type: function() {
					return currentUser.type ? currentUser.type : "none";
				},
				userId: function() {
					return currentUser.id;
				},
				user: function() {
					return currentUser;
				},
				logout: function() {
					currentUser = {};
				}
			};
		}]);
})();

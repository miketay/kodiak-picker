(function() {
	'use strict';

	angular.module('Student')
		.factory('StudentFactory', ['$http', '$q', 'Constants', function StudentFactory($http, $q, Constants) {
			return {
				upload: function(file) {
					var defer = $q.defer();
					var formData = new FormData();
					formData.append('list', file, file.name);
					
					$http.post(Constants.api_url()+"students/import.json", formData).success(function(data) {
						$q.resolve(data);
					}).error(function(data, status) {
						if (data === null) {
							data = {};
						}
						if (typeof data === "object") {
							data.status = status;
						}
						$q.reject(data);
					});

					return defer.promise;
				}
			};
		}]);
})();

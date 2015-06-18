(function() {
	'use strict';

	angular.module('Config')
		.factory("Constants", ['$location', function ConstantsFactory($location) {
			var api_url = FULL_BASE_URL+"api/";

			return {
				api_url: function() { return api_url; },
			};
		}]);
})();


(function() {
	'use strict';

	angular.module('Page')
		.factory('Page', [function PageFactory() {
			var title = "";

			return {
				title: function(newTitle) {
					if (newTitle) {
						title = newTitle;
					}
					return title;
				}
			};
		}]);
})();


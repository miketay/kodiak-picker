(function() {
	'use strict';

	angular.module('Page')
	.directive('fileUpload', [function(){
		return {
			restrict: 'A',
			link: function(scope, element, attrs){
				var func = attrs.fileUpload;

				element.bind('change', function(){
					if(typeof scope[func] == "function"){
						scope[func](element[0].files);
					}
				});
			}
		}
	}]);
})();


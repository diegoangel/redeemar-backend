'use strict';

/**
 * @ngdoc overview
 * @name Redeemar
 * @description
 *
 * Main module of the application.
 */
angular
.module('redeemar', [
    'config',
    'ngAnimate',
    'ngSanitize',
    'ngTouch'
])
.run(['ENV','$location', function(ENV, $location) {

}])
.config([function() {

}]);
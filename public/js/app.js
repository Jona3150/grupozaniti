var zanitiApp = angular.module('zanitiApp', []);

zanitiApp.config(['$httpProvider', function($httpProvider) {
    // Esto le dice a Angular que extraiga el token de la cookie XSRF-TOKEN 
    // que Laravel envía automáticamente.
    $httpProvider.defaults.xsrfCookieName = 'XSRF-TOKEN';
    $httpProvider.defaults.xsrfHeaderName = 'X-XSRF-TOKEN';
}]);

zanitiApp.run(['$rootScope', '$http', function($rootScope, $http) {
    $rootScope.menuAbierto = false; 

    // Configuración manual de respaldo
    let token = document.querySelector('meta[name="csrf-token"]');
    if (token) {
        $http.defaults.headers.common['X-CSRF-TOKEN'] = token.getAttribute('content');
        $http.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
    }
}]);
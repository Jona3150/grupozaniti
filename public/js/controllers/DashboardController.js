zanitiApp.controller('DashboardController', ['$scope', '$http', '$timeout', function($scope, $http, $timeout) {
    
    $scope.stats = {};
    $scope.mostrarBienvenida = true;

    // Desaparecer mensaje después de 4 segundos
    $timeout(function() {
        $scope.mostrarBienvenida = false;
    }, 4000);

    $scope.obtenerStats = function() {
        $http.get('/datos-dashboard').then(function(response) {
            $scope.stats = response.data;
        });
    };

    $scope.obtenerStats();
}]);
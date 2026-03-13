// Definimos el controlador para el login
zanitiApp.controller('LoginController', ['$scope', '$window', function($scope, $window) {
    $scope.datos = {
        email: '',
        password: ''
    };

    $scope.intentarLogin = function() {
        console.log("Validando...");
        if ($scope.datos.email === 'admin@zaniti.com' && $scope.datos.password === 'admin123') {
            $window.location.href = '/dashboard';
        } else {
            alert("Credenciales incorrectas");
        }
    };
}]);
/**
 * Controlador de AngularJS para la Gestión de Clientes - Zaniti
 */
zanitiApp.controller('ClientesController', ['$scope', '$http', function ($scope, $http) {

    // --- Variables de Estado ---
    $scope.clientes = [];
    $scope.cargando = true;
    $scope.busqueda = "";
    $scope.filtroTipo = ""; // Controla las pestañas de filtrado (Residencial, Comercial, etc.)
    $scope.mostrarModal = false;
    $scope.editando = false;
    $scope.nuevoCliente = {};

    /**
     * 1. Cargar Clientes desde la Base de Datos
     */
    $scope.obtenerClientes = function () {
        $scope.cargando = true;
        $http.get('/datos-clientes').then(function (response) {
            $scope.clientes = response.data;
            $scope.cargando = false;
        }, function (error) {
            console.error("Error al cargar la lista de clientes:", error);
            $scope.cargando = false;
        });
    };

    /**
     * 2. Control de Apertura y Cierre del Modal
     */
    $scope.abrirModal = function () {
        $scope.editando = false;
        $scope.nuevoCliente = {
            tipo: 'Residencial', // Valor inicial por defecto
            estado: 'Activo'
        };
        $scope.mostrarModal = true;
    };

    $scope.editarCliente = function (cliente) {
        $scope.editando = true;
        // Usamos angular.copy para no alterar la lista principal hasta que el servidor confirme
        $scope.nuevoCliente = angular.copy(cliente);
        $scope.mostrarModal = true;
    };

    $scope.cerrarModal = function () {
        $scope.mostrarModal = false;
        $scope.nuevoCliente = {};
        $scope.editando = false;
    };

    /**
     * 3. Guardar o Actualizar Cliente (Con lógica de campo "Otro")
     */
    $scope.guardarCliente = function () {

        if ($scope.nuevoCliente.telefono) {
            $scope.nuevoCliente.telefono = $scope.nuevoCliente.telefono.toString().replace(/\D/g, '');
        }

        // 2. Validar que tenga exactamente 10 dígitos
        if (!$scope.nuevoCliente.telefono || $scope.nuevoCliente.telefono.length !== 10) {
            alert("El número de teléfono debe tener exactamente 10 dígitos.");
            return;
        }
        // 1. Evitar múltiples envíos si ya se está procesando
        if ($scope.guardando) return;

        // Validación de campos requeridos por la base de datos
        if (!$scope.nuevoCliente.nombre || !$scope.nuevoCliente.telefono || !$scope.nuevoCliente.direccion) {
            alert("Por favor, completa Nombre, Teléfono y Dirección.");
            return;
        }

        // --- PROCESAR OPCIÓN "OTRO" PARA TIPO DE CLIENTE ---
        let datosAEnviar = angular.copy($scope.nuevoCliente);

        if (datosAEnviar.tipo === 'Otro') {
            if (!datosAEnviar.tipo_otro || datosAEnviar.tipo_otro.trim() === "") {
                alert("Por favor, especifica el nuevo tipo de cliente.");
                return;
            }
            datosAEnviar.tipo = datosAEnviar.tipo_otro;
        }

        // 2. Activamos el estado de bloqueo
        $scope.guardando = true;

        let url = $scope.editando ? '/clientes/actualizar/' + datosAEnviar.id : '/clientes/guardar';

        $http.post(url, datosAEnviar).then(function (response) {
            // Recargamos la lista para ver el nuevo cliente o los cambios
            $scope.obtenerClientes();
            $scope.cerrarModal();
            alert($scope.editando ? "Cliente actualizado con éxito" : "Cliente registrado con éxito");
        }, function (error) {
            console.error("Error en la operación de cliente:", error);
            alert("Hubo un error al procesar la solicitud. Verifica los datos.");
        }).finally(function () {
            // 3. Liberamos el botón siempre, incluso si hubo error
            $scope.guardando = false;
        });
    };

    /**
     * 4. Eliminar Cliente del Sistema
     */
    $scope.eliminarCliente = function (id) {
        if (confirm("¿Estás seguro de eliminar este cliente? Se borrará de forma permanente de la base de datos.")) {
            $http.post('/clientes/eliminar/' + id).then(function (response) {
                $scope.obtenerClientes();
            }, function (error) {
                console.error("Error al eliminar cliente:", error);
                alert("No se pudo eliminar el registro.");
            });
        }
    };

    // --- Ejecución automática al cargar la página ---
    $scope.obtenerClientes();

}]);
/**
 * Controlador de AngularJS para la gestión del Inventario - Zaniti
 */
zanitiApp.controller('InventarioController', ['$scope', '$http', function($scope, $http) {
    
    // --- Variables de Estado ---
    $scope.productos = [];
    $scope.cargando = true;
    $scope.busqueda = ""; 
    $scope.mostrarModal = false; 
    $scope.editando = false; 
    $scope.datosLlenos = false; // Controla la pista visual de autocompletado
    $scope.nuevoProducto = {};

    /**
     * 1. Cargar inventario desde la base de datos
     */
    $scope.obtenerInventario = function() {
        $scope.cargando = true;
        $http.get('/datos-inventario').then(function(response) {
            $scope.productos = response.data;
            $scope.cargando = false;
        }, function(error) {
            console.error("Error al cargar datos:", error);
            $scope.cargando = false;
        });
    };

    /**
     * 2. Lógica de Autocompletado para Proveedor
     * Se activa con TAB o Doble Clic en la vista
     */
    $scope.autocompletarProveedor = function() {
        if (!$scope.nuevoProducto.proveedor || $scope.nuevoProducto.proveedor.length < 2) return;

        // Buscar coincidencia en productos ya registrados
        let coincidencia = $scope.productos.find(function(p) {
            return p.proveedor && p.proveedor.toLowerCase().includes($scope.nuevoProducto.proveedor.toLowerCase());
        });

        if (coincidencia) {
            $scope.nuevoProducto.proveedor = coincidencia.proveedor;
            $scope.datosLlenos = true;
            console.log("Proveedor autocompletado:", coincidencia.proveedor);
        }
    };

    /**
     * 3. Funciones del Modal
     */
    $scope.abrirModal = function() {
        $scope.editando = false;
        $scope.datosLlenos = false;
        $scope.nuevoProducto = {
            cantidad: 0,
            stock_minimo: 5,
            categoria: 'Insecticidas',
            proveedor: ''
        };
        $scope.mostrarModal = true;
    };

    $scope.editarProducto = function(producto) {
        $scope.editando = true;
        $scope.nuevoProducto = angular.copy(producto);
        $scope.mostrarModal = true;
    };

    $scope.cerrarModal = function() {
        $scope.mostrarModal = false;
        $scope.nuevoProducto = {};
        $scope.editando = false;
        $scope.datosLlenos = false;
    };

    /**
     * 4. Guardar o Actualizar Producto
     */
    $scope.guardarProducto = function() {
        // Validación básica
        if (!$scope.nuevoProducto.nombre || $scope.nuevoProducto.precio === undefined) {
            alert("El nombre y el precio son obligatorios.");
            return;
        }

        // --- PROCESAR OPCIÓN "OTRO" PARA CATEGORÍA ---
        let datosAEnviar = angular.copy($scope.nuevoProducto);

        if (datosAEnviar.categoria === 'Otro') {
            if (!datosAEnviar.categoria_otra) {
                alert("Por favor especifica la nueva categoría.");
                return;
            }
            datosAEnviar.categoria = datosAEnviar.categoria_otra;
        }

        let url = $scope.editando ? '/productos/actualizar/' + datosAEnviar.id : '/productos/guardar';
        
        $http.post(url, datosAEnviar).then(function(response) {
            $scope.obtenerInventario(); // Recarga para que el nuevo proveedor/categoría ya sea "conocido"
            $scope.cerrarModal();
        }, function(error) {
            console.error("Error:", error);
            alert("Hubo un error al procesar la solicitud.");
        });
    };

    /**
     * 5. Utilidades y Métricas
     */
    $scope.eliminarProducto = function(id) {
        if(confirm("¿Estás seguro de eliminar este producto de forma permanente?")) {
            $http.post('/productos/eliminar/' + id).then(function(response) {
                $scope.obtenerInventario();
            });
        }
    };

    $scope.esStockBajo = function(producto) {
        return parseInt(producto.cantidad) <= parseInt(producto.stock_minimo);
    };

    $scope.calcularValorTotal = function() {
        let total = 0;
        angular.forEach($scope.productos, function(p) {
            total += (parseFloat(p.precio) * parseInt(p.cantidad));
        });
        return total;
    };

    // --- Inicio ---
    $scope.obtenerInventario();

}]);
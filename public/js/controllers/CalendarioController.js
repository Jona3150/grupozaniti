/**
 * Controlador de AngularJS para el Calendario de Servicios - Zaniti
 */
zanitiApp.controller('CalendarioController', ['$scope', '$http', function($scope, $http) {
    
    // --- Variables de Estado ---
    $scope.servicios = [];
    $scope.serviciosDelDia = [];
    $scope.empleados = [];
    $scope.diaSeleccionado = new Date().getDate(); 
    $scope.mostrarModal = false;
    $scope.editando = false;
    $scope.nuevoServicio = {};

    /**
     * 1. Carga de Datos
     */
    $scope.obtenerDatos = function() {
        $http.get('/datos-servicios').then(function(response) {
            $scope.servicios = response.data.servicios;
            $scope.empleados = response.data.empleados;
            $scope.filtrarPorDia($scope.diaSeleccionado);
        }, function(error) {
            console.error("Error al cargar servicios:", error);
        });
    };

    /**
     * 2. Lógica de Autocompletado (TAB / Doble Clic)
     */
    $scope.autocompletarCliente = function() {
        if (!$scope.nuevoServicio.cliente || $scope.nuevoServicio.cliente.length < 2) return;
        
        let coincidencia = $scope.servicios.find(s => 
            s.cliente.toLowerCase().includes($scope.nuevoServicio.cliente.toLowerCase())
        );

        if (coincidencia) {
            $scope.nuevoServicio.cliente = coincidencia.cliente;
            $scope.nuevoServicio.direccion = coincidencia.direccion;
            $scope.nuevoServicio.tipo_servicio = coincidencia.tipo_servicio;
            console.log("Cliente autocompletado:", coincidencia.cliente);
        }
    };

    /**
     * 3. Gestión del Calendario
     */
    $scope.seleccionarDia = function(dia) {
        $scope.diaSeleccionado = dia;
        $scope.filtrarPorDia(dia);
    };

    $scope.filtrarPorDia = function(dia) {
        let diaStr = dia.toString().padStart(2, '0');
        // Filtramos por el mes actual (Marzo 2026 según tu configuración)
        let fechaBusqueda = "2026-03-" + diaStr;
        $scope.serviciosDelDia = $scope.servicios.filter(s => s.fecha.includes(fechaBusqueda));
    };

    /**
     * 4. Guardar Servicio (Con lógica de campo "Otro")
     */
    $scope.guardarServicio = function() {
        if (!$scope.nuevoServicio.cliente || !$scope.nuevoServicio.direccion) {
            alert("Campos obligatorios incompletos (Cliente y Dirección).");
            return;
        }

        // Clonamos el objeto para no ensuciar la vista mientras procesamos
        let payload = angular.copy($scope.nuevoServicio);

        // --- PROCESAR OPCIÓN "OTRO" ---
        if (payload.tipo_servicio === 'Otro') {
            if (!payload.tipo_otro) {
                alert("Por favor, especifica el tipo de servicio.");
                return;
            }
            payload.tipo_servicio = payload.tipo_otro;
        }

        // --- FORMATEO DE FECHA PARA LARAVEL ---
        if (payload.fecha instanceof Date) {
            let m = (payload.fecha.getMonth() + 1).toString().padStart(2, '0');
            let d = payload.fecha.getDate().toString().padStart(2, '0');
            payload.fecha = `${payload.fecha.getFullYear()}-${m}-${d}`;
        }

        // --- FORMATEO DE HORA PARA LARAVEL ---
        if (payload.hora instanceof Date) {
            let h = payload.hora.getHours().toString().padStart(2, '0');
            let i = payload.hora.getMinutes().toString().padStart(2, '0');
            payload.hora = `${h}:${i}:00`;
        }

        let url = $scope.editando ? '/servicios/actualizar/' + payload.id : '/servicios/guardar';

        $http.post(url, payload).then(function(response) {
            $scope.obtenerDatos(); // Recargar para ver los cambios
            $scope.cerrarModal();
        }, function(error) {
            console.error("Error al guardar:", error.data);
            alert("Error al guardar: " + (error.data.message || "Error de servidor"));
        });
    };

    /**
     * 5. Control de Modales
     */
    $scope.abrirModal = function() {
        $scope.editando = false;
        let diaStr = $scope.diaSeleccionado.toString().padStart(2, '0');
        
        $scope.nuevoServicio = {
            fecha: new Date(`2026-03-${diaStr}T12:00:00`),
            hora: new Date(2026, 2, $scope.diaSeleccionado, 10, 0, 0),
            estado: 'Programado',
            tipo_servicio: 'Fumigación Residencial'
        };
        $scope.mostrarModal = true;
    };

    $scope.editarServicio = function(servicio) {
        $scope.editando = true;
        $scope.nuevoServicio = angular.copy(servicio);
        
        // Convertir strings de BD a objetos Date para los inputs
        $scope.nuevoServicio.fecha = new Date(servicio.fecha + "T12:00:00");
        let h = servicio.hora.split(':');
        $scope.nuevoServicio.hora = new Date(2026, 2, 1, h[0], h[1], 0);
        
        $scope.mostrarModal = true;
    };

    $scope.cerrarModal = function() {
        $scope.mostrarModal = false;
        $scope.nuevoServicio = {};
        $scope.editando = false;
    };

    $scope.eliminarServicio = function(id) {
        if (confirm("¿Seguro que deseas cancelar este servicio de forma permanente?")) {
            $http.post('/servicios/eliminar/' + id).then(() => {
                $scope.obtenerDatos();
            }, (error) => {
                alert("No se pudo eliminar el servicio.");
            });
        }
    };

    // --- Ejecución Inicial ---
    $scope.obtenerDatos();

}]);
/**
 * Controlador de AngularJS para el Calendario de Servicios - Zaniti
 */
zanitiApp.controller('ServicioController', ['$scope', '$http', function ($scope, $http) {

    // --- Variables de Estado ---
    $scope.servicios = [];       // Lista completa de servicios
    $scope.serviciosDelDia = [];  // Lista filtrada para la derecha
    $scope.clientes = [];
    $scope.tecnicos = [];        // Sincronizado con el backend (Sonia, Fernando, Víctor)
    $scope.cargando = true;
    $scope.mostrarModal = false;
    $scope.editando = false;
    $scope.nuevoServicio = {};

    // Control visual del calendario
    $scope.diaSeleccionado = new Date().getDate();
    $scope.diaActual = new Date().getDate();

    /**
     * 1. Inicialización
     */
    $scope.init = function () {
        $scope.obtenerDatos();
        $scope.obtenerClientes();
    };

    // Obtiene servicios y técnicos desde Laravel
    $scope.obtenerDatos = function () {
        $scope.cargando = true;
        $http.get('/datos-servicios').then(function (response) {
            $scope.servicios = response.data.servicios || [];
            // IMPORTANTE: Aquí asignamos los técnicos que vienen de la tabla Users
            $scope.tecnicos = response.data.tecnicos || [];

            $scope.actualizarFiltroDia();
            $scope.cargando = false;
        }, function (error) {
            console.error("Error al cargar datos:", error);
            $scope.cargando = false;
        });
    };

    $scope.obtenerClientes = function () {
        $http.get('/datos-clientes').then(function (response) {
            $scope.clientes = response.data;
        });
    };

    /**
     * 2. Lógica del Calendario
     */
    $scope.seleccionarDia = function (dia) {
        $scope.diaSeleccionado = dia;
        $scope.actualizarFiltroDia();
    };

    $scope.actualizarFiltroDia = function () {
        let mes = "03"; // Marzo 2026
        let diaStr = $scope.diaSeleccionado < 10 ? '0' + $scope.diaSeleccionado : $scope.diaSeleccionado;
        let fechaBusqueda = `2026-${mes}-${diaStr}`;

        $scope.serviciosDelDia = $scope.servicios.filter(function (s) {
            // Limpiamos la fecha por si viene con hora de la DB
            let fechaServicio = s.fecha.split('T')[0];
            return fechaServicio === fechaBusqueda;
        });
    };

    /**
     * 3. Control del Modal (Solución al error datefmt)
     */
    $scope.abrirModal = function () {
        $scope.editando = false;

        // CORRECCIÓN: Usamos objetos Date reales para evitar el error [ngModel:datefmt]
        let fechaParaModal = new Date(2026, 2, $scope.diaSeleccionado); // Mes 2 = Marzo
        let horaPredeterminada = new Date();
        horaPredeterminada.setHours(9, 0, 0, 0);

        $scope.nuevoServicio = {
            fecha: fechaParaModal,
            hora: horaPredeterminada,
            estado: 'Programado',
            tipo_servicio: 'Fumigación Residencial'
        };
        $scope.mostrarModal = true;
    };

    $scope.cerrarModal = function () {
        $scope.mostrarModal = false;
        $scope.nuevoServicio = {};
    };

    /**
     * 4. Guardar o Actualizar
     */
    $scope.guardarServicio = function () {
        // 1. Evitar múltiples clics si ya se está procesando
        if ($scope.guardando) return;

        if (!$scope.nuevoServicio.cliente || !$scope.nuevoServicio.tecnico || !$scope.nuevoServicio.direccion) {
            alert("Por favor, completa Cliente, Técnico y Dirección.");
            return;
        }

        // 2. Bloqueamos el proceso
        $scope.guardando = true;

        // Preparamos los datos para Laravel (convertimos Date a String)
        let datosAEnviar = angular.copy($scope.nuevoServicio);

        if (datosAEnviar.fecha instanceof Date) {
            datosAEnviar.fecha = datosAEnviar.fecha.toISOString().split('T')[0];
        }
        if (datosAEnviar.hora instanceof Date) {
            datosAEnviar.hora = datosAEnviar.hora.getHours().toString().padStart(2, '0') + ':' +
                datosAEnviar.hora.getMinutes().toString().padStart(2, '0');
        }

        let url = $scope.editando ? '/servicios/actualizar/' + datosAEnviar.id : '/servicios/guardar';

        $http.post(url, datosAEnviar).then(function (response) {
            $scope.obtenerDatos();
            $scope.cerrarModal();
            alert("¡Servicio guardado con éxito!");
        }, function (error) {
            console.error("Error al guardar:", error);
            alert("No se pudo guardar. Verifica que todos los campos estén llenos.");
        }).finally(function () {
            // 3. Pase lo que pase (éxito o error), liberamos el botón al terminar
            $scope.guardando = false;
        });
    };

    /**
     * 5. Editar y Eliminar
     */
    $scope.editarServicio = function (servicio) {
        $scope.editando = true;
        let clon = angular.copy(servicio);

        // 1. Obtener la fecha de hoy en formato Date de JS
        let hoy = new Date();
        hoy.setHours(0, 0, 0, 0);

        // 2. Corregir la Fecha
        if (clon.fecha) {
            // Usamos el reemplazo de guiones por barras para evitar el error de "un día menos"
            // y creamos el objeto Date directamente.
            let fechaConvertida = new Date(clon.fecha.replace(/-/g, '\/'));

            // Si la fecha es válida, la asignamos; si no, ponemos la de hoy
            $scope.nuevoServicio_fecha = (isNaN(fechaConvertida.getTime())) ? hoy : fechaConvertida;
        } else {
            $scope.nuevoServicio_fecha = hoy;
        }

        // 3. Corregir la Hora
        if (clon.hora) {
            let parts = clon.hora.split(':');
            let h = new Date();
            h.setHours(parseInt(parts[0]), parseInt(parts[1]), 0, 0);
            clon.hora = h;
        } else {
            // Si no hay hora, podemos poner la hora actual por defecto
            let h = new Date();
            h.setSeconds(0);
            h.setMilliseconds(0);
            clon.hora = h;
        }

        // 4. Asignar la fecha corregida al objeto que usa el modal
        clon.fecha = $scope.nuevoServicio_fecha;

        $scope.nuevoServicio = clon;
        $scope.mostrarModal = true;
    };

    $scope.eliminarServicio = function (id) {
        if (confirm("¿Eliminar este servicio?")) {
            $http.post('/servicios/eliminar/' + id).then(function () {
                $scope.obtenerDatos();
            });
        }
    };

    $scope.init();
}]);
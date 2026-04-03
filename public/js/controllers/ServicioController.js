/**
 * Controlador de AngularJS para el Calendario de Servicios - Zaniti
 * Versión: Navegación Dinámica + Métricas filtradas por mes en curso
 */
zanitiApp.controller('ServicioController', ['$scope', '$http', function ($scope, $http) {

    // --- 1. Variables de Estado ---
    $scope.servicios = [];           // Lista maestra de la base de datos
    $scope.serviciosDelMes = [];      // NUEVO: Lista filtrada para las métricas (cards de arriba)
    $scope.serviciosDelDia = [];      // Lista filtrada para el panel derecho
    $scope.clientes = [];
    $scope.tecnicos = [];
    $scope.mostrarModal = false;
    $scope.editando = false;
    $scope.nuevoServicio = {};
    $scope.guardando = false;

    // --- 2. Lógica Dinámica de Fecha ---
    let hoy = new Date();
    $scope.mesActual = hoy.getMonth();
    $scope.anioActual = hoy.getFullYear();
    $scope.diaSeleccionado = hoy.getDate();

    $scope.diaHoy = hoy.getDate();
    $scope.mesHoy = hoy.getMonth();
    $scope.anioHoy = hoy.getFullYear();

    $scope.nombresMeses = [
        "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio",
        "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"
    ];

    /**
     * 3. Generar el Grid del Calendario
     */
    $scope.generarCalendario = function () {
        $scope.diasDelMes = [];
        let primerDiaSemana = new Date($scope.anioActual, $scope.mesActual, 1).getDay();
        let totalDias = new Date($scope.anioActual, $scope.mesActual + 1, 0).getDate();

        for (let i = 0; i < primerDiaSemana; i++) $scope.diasDelMes.push(null);
        for (let d = 1; d <= totalDias; d++) $scope.diasDelMes.push(d);
    };

    /**
     * 4. Navegación y Filtros (CORRECCIÓN MÉTRICAS POR MES)
     */
    $scope.actualizarFiltrosGlobales = function () {
        // Formato para comparar mes y año (YYYY-MM)
        let m = ($scope.mesActual + 1).toString().padStart(2, '0');
        let prefijoMes = `${$scope.anioActual}-${m}`;

        // 1. Filtrar para las métricas del mes (Cards superiores)
        $scope.serviciosDelMes = $scope.servicios.filter(function (s) {
            return s.fecha.startsWith(prefijoMes);
        });

        // 2. Filtrar para el panel derecho (Día seleccionado)
        let d = $scope.diaSeleccionado.toString().padStart(2, '0');
        let fechaBusqueda = `${prefijoMes}-${d}`;

        $scope.serviciosDelDia = $scope.servicios.filter(function (s) {
            let fechaLimpia = s.fecha.split('T')[0].split(' ')[0];
            return fechaLimpia === fechaBusqueda;
        });
    };

    $scope.cambiarMes = function (direccion) {
        $scope.mesActual += direccion;
        if ($scope.mesActual > 11) {
            $scope.mesActual = 0;
            $scope.anioActual++;
        } else if ($scope.mesActual < 0) {
            $scope.mesActual = 11;
            $scope.anioActual--;
        }
        $scope.generarCalendario();
        $scope.seleccionarDia(1);
    };

    $scope.seleccionarDia = function (dia) {
        if (!dia) return;
        $scope.diaSeleccionado = dia;
        $scope.actualizarFiltrosGlobales();
    };

    /**
     * 5. CRUD: Obtener, Guardar, Editar y Eliminar
     */
    $scope.obtenerDatos = function () {
        $http.get('/datos-servicios').then(function (response) {
            $scope.servicios = response.data.servicios || [];
            $scope.tecnicos = response.data.tecnicos || [];
            $scope.actualizarFiltrosGlobales();
        });

        $http.get('/datos-clientes').then(function (response) {
            let todosLosClientes = response.data || [];

            // Solo guardamos los activos para que el modal de agendar esté limpio
            $scope.clientes = todosLosClientes.filter(function (c) {
                return c.estado === 'Activo';
            });
        }).catch(function (err) {
            console.error("Error cargando clientes:", err);
        });
    };

    $scope.guardarServicio = function () {
        if (!$scope.nuevoServicio.cliente || !$scope.nuevoServicio.direccion) {
            alert("Campos obligatorios incompletos.");
            return;
        }

        $scope.guardando = true;
        let payload = angular.copy($scope.nuevoServicio);

        if (payload.tipo_servicio === 'Otro') {
            payload.tipo_servicio = payload.tipo_otro;
        }

        if (payload.fecha instanceof Date) {
            let mon = (payload.fecha.getMonth() + 1).toString().padStart(2, '0');
            let day = payload.fecha.getDate().toString().padStart(2, '0');
            payload.fecha = `${payload.fecha.getFullYear()}-${mon}-${day}`;
        }

        if (payload.hora instanceof Date) {
            let h = payload.hora.getHours().toString().padStart(2, '0');
            let i = payload.hora.getMinutes().toString().padStart(2, '0');
            payload.hora = `${h}:${i}:00`;
        }

        let url = $scope.editando ? '/servicios/actualizar/' + payload.id : '/servicios/guardar';

        $http.post(url, payload).then(function (response) {
            $scope.obtenerDatos();
            $scope.cerrarModal();
        }, function (error) {
            alert("Error al guardar: " + (error.data.message || "Error de servidor"));
        }).finally(function () {
            $scope.guardando = false;
        });
    };

    $scope.eliminarServicio = function (id) {
        if (confirm("¿Seguro que deseas cancelar este servicio?")) {
            $http.post('/servicios/eliminar/' + id).then(() => $scope.obtenerDatos());
        }
    };

    /**
     * 6. Gestión de Modales
     */
    $scope.abrirModal = function () {
        $scope.editando = false;
        let f = new Date($scope.anioActual, $scope.mesActual, $scope.diaSeleccionado, 12, 0, 0);
        let h = new Date();
        h.setHours(10, 0, 0, 0);

        $scope.nuevoServicio = {
            fecha: f,
            hora: h,
            estado: 'Programado',
            tipo_servicio: 'Fumigación Residencial'
        };
        $scope.mostrarModal = true;
    };

    $scope.editarServicio = function (servicio) {
        $scope.editando = true;
        let clon = angular.copy(servicio);

        if (clon.fecha) {
            let parts = clon.fecha.split('T')[0].split(' ')[0].split('-');
            clon.fecha = new Date(parts[0], parts[1] - 1, parts[2], 12, 0, 0);
        }
        if (clon.hora) {
            let t = clon.hora.split(':');
            let h = new Date();
            h.setHours(t[0], t[1], 0, 0);
            clon.hora = h;
        }

        $scope.nuevoServicio = clon;
        $scope.mostrarModal = true;
    };

    $scope.cerrarModal = function () {
        $scope.mostrarModal = false;
        $scope.editando = false;
    };

    // Inicialización
    $scope.generarCalendario();
    $scope.obtenerDatos();

}]);
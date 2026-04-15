<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Servicio;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ServicioController extends Controller
{
    /**
     * Obtener servicios y lista de técnicos
     */
    public function index()
    {
        try {
            return response()->json([
                // Obtener todos los servicios de la nueva tabla
                'servicios' => Servicio::orderBy('fecha', 'asc')->orderBy('hora', 'asc')->get(),

                // Obtener los técnicos de la tabla USERS
                'tecnicos' => User::whereIn('role', ['admin', 'empleado', 'dueño'])
                ->select('id', 'name', 'role')
                ->get()
            ]);
        }
        catch (\Exception $e) {
            Log::error("Error en index de servicios: " . $e->getMessage());
            return response()->json(['error' => 'Error al cargar datos'], 500);
        }
    }

    /**
     * Guardar un nuevo servicio en la base de datos
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'fecha' => 'required|date',
            'hora' => 'required',
            'cliente' => 'required|string|max:255',
            'tipo_servicio' => 'required|string',
            'direccion' => 'required|string',
            'tecnico' => 'required|string',
            'notas' => 'nullable|string',
            'estado' => 'required|string'
        ]);

        try {
            $servicio = Servicio::create($validatedData);

            return response()->json([
                'status' => 'success',
                'message' => 'Servicio agendado correctamente',
                'data' => $servicio
            ], 201);

        }
        catch (\Exception $e) {
            Log::error("Error al guardar servicio: " . $e->getMessage());
            return response()->json(['error' => 'No se pudo guardar el servicio'], 500);
        }
    }

    /**
     * Actualizar un servicio
     */
    public function update(Request $request, $id)
    {
        $servicio = Servicio::find($id);

        if (!$servicio) {
            return response()->json(['message' => 'Servicio no encontrado'], 404);
        }

        $validatedData = $request->validate([
            'fecha' => 'required|date',
            'hora' => 'required',
            'cliente' => 'required|string',
            'tipo_servicio' => 'required|string',
            'direccion' => 'required|string',
            'tecnico' => 'required|string',
            'estado' => 'required|string',
            'notas' => 'nullable|string'
        ]);

        $servicio->update($validatedData);
        return response()->json(['status' => 'success', 'data' => $servicio]);
    }

    /**
     * Eliminar un servicio
     */
    public function destroy($id)
    {
        $servicio = Servicio::find($id);
        if ($servicio) {
            $servicio->delete();
            return response()->json(['status' => 'success']);
        }
        return response()->json(['error' => 'No encontrado'], 404);
    }
}
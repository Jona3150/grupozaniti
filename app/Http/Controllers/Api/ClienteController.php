<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cliente; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Exception;

class ClienteController extends Controller
{
    /**
     * Listar clientes
     */
    public function index()    {
        try {
            // Obtener TODOS los clientes para poder gestionarlos en su vista
            $clientes = \App\Models\Cliente::orderBy('nombre', 'asc')->get();
            return response()->json($clientes);
        }
        catch (Exception $e) {
            Log::error("Error en Zaniti Index: " . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }    }

    /**
     * Guardar cliente
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'tipo' => 'required|string',
            'telefono' => 'required|string',
            'direccion' => 'required|string',
        ]);

        try {
            $cliente = \App\Models\Cliente::create($request->all());
            return response()->json([
                'message' => 'Cliente guardado correctamente',
                'cliente' => $cliente
            ], 201);
        }
        catch (Exception $e) {
            Log::error("Error en Zaniti Store: " . $e->getMessage());
            return response()->json([
                'message' => 'Error en el servidor',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Actualizar cliente
     */
    public function update(Request $request, $id)
    {
        try {
            $cliente = \App\Models\Cliente::findOrFail($id);
            $cliente->update($request->all());
            return response()->json(['message' => 'Actualizado con éxito', 'cliente' => $cliente]);
        }
        catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Eliminar cliente
     */
    public function destroy($id)
    {
        try {
            \App\Models\Cliente::destroy($id);
            return response()->json(['message' => 'Eliminado correctamente']);
        }
        catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
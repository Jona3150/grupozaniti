<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Producto;
use Illuminate\Http\Request;

class InventarioController extends Controller
{
    /**
     * Listar todos los productos
     */
    public function index() {
        return response()->json(Producto::orderBy('created_at', 'desc')->get());
    }

    /**
     * Guardar un nuevo producto (CREATE)
     */
    public function store(Request $request) {
        $validados = $request->validate([
            'nombre' => 'required|string|max:255',
            'categoria' => 'required|string',
            'cantidad' => 'required|integer',
            'unidad_medida' => 'required|string',
            'precio' => 'required|numeric',
            'stock_minimo' => 'required|integer',
            'proveedor' => 'required|string'
        ]);

        $producto = Producto::create($validados);
        return response()->json($producto, 201);
    }

    /**
     * Actualizar un producto existente (UPDATE)
     */
    public function update(Request $request, $id) {
        $producto = Producto::find($id);

        if (!$producto) {
            return response()->json(['message' => 'Producto no encontrado'], 404);
        }

        $validados = $request->validate([
            'nombre' => 'required|string|max:255',
            'categoria' => 'required|string',
            'cantidad' => 'required|integer',
            'unidad_medida' => 'required|string',
            'precio' => 'required|numeric',
            'stock_minimo' => 'required|integer',
            'proveedor' => 'required|string'
        ]);

        $producto->update($validados);

        return response()->json([
            'status' => 'success',
            'data' => $producto
        ]);
    }

    /**
     * Eliminar un producto (DELETE)
     */
    public function destroy($id) {
        $producto = Producto::find($id);

        if (!$producto) {
            return response()->json(['message' => 'Producto no encontrado'], 404);
        }

        $producto->delete();

        return response()->json(['status' => 'success']);
    }
}
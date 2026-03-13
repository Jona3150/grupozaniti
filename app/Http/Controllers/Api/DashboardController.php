<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use App\Models\Servicio;
use App\Models\Producto;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function getStats()
    {
        $productos = Producto::all();
        $servicios = Servicio::all();
        
        return response()->json([
            // Métricas de las tarjetas superiores
            'servicios_mes' => Servicio::whereMonth('fecha', now()->month)->count(),
            'servicios_completados_pct' => Servicio::count() > 0 ? round((Servicio::where('estado', 'Completado')->count() / Servicio::count()) * 100) : 0,
            'productos_stock' => $productos->sum('cantidad'),
            'productos_bajos' => Producto::whereRaw('cantidad <= stock_minimo')->count(),
            'clientes_activos' => Cliente::count(),
            'valor_inventario' => $productos->sum(fn($p) => $p->precio * $p->cantidad),
            'total_productos' => $productos->count(),
            
            // Listados para las secciones inferiores
            'servicios_recientes' => Servicio::orderBy('fecha', 'desc')->take(3)->get(),
            'stock_critico' => Producto::whereRaw('cantidad <= stock_minimo')->take(3)->get()
        ]);
    }
}
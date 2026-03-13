<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Producto;

class ProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $productos = [
            [
                'nombre' => 'Insecticida Premium',
                'categoria' => 'Insecticidas',
                'cantidad' => 15,
                'unidad_medida' => 'L',
                'precio' => 45.00,
                'stock_minimo' => 10,
                'proveedor' => 'QuímicaPro'
            ],
            [
                'nombre' => 'Raticida en Gel',
                'categoria' => 'Raticidas',
                'cantidad' => 3,
                'unidad_medida' => 'kg',
                'precio' => 35.00,
                'stock_minimo' => 5,
                'proveedor' => 'PlagasControl'
            ],
            [
                'nombre' => 'Desinfectante Industrial',
                'categoria' => 'Desinfectantes',
                'cantidad' => 20,
                'unidad_medida' => 'L',
                'precio' => 25.50,
                'stock_minimo' => 15,
                'proveedor' => 'QuímicaPro'
            ]
        ];

        foreach ($productos as $producto) {
            Producto::create($producto);
        }
    }
}
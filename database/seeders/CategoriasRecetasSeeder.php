<?php

namespace Database\Seeders;

use App\Models\Categoria;
use App\Models\Receta;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class CategoriasRecetasSeeder extends Seeder
{
    public function run()
    {
        // Crear directorio para imágenes si no existe
        if (!Storage::exists('recetas')) {
            Storage::makeDirectory('recetas');
        }

        // Crear categorías
        $categorias = [
            [
                'nombre' => 'Desayunos',
                'descripcion' => 'Recetas ideales para comenzar el día con energía.'
            ],
            [
                'nombre' => 'Almuerzos',
                'descripcion' => 'Platos principales para la hora del almuerzo.'
            ],
            [
                'nombre' => 'Cenas',
                'descripcion' => 'Opciones ligeras y deliciosas para terminar el día.'
            ],
            [
                'nombre' => 'Postres',
                'descripcion' => 'Dulces delicias para cualquier ocasión.'
            ],
            [
                'nombre' => 'Bebidas',
                'descripcion' => 'Refrescantes opciones para hidratarse.'
            ]
        ];

        foreach ($categorias as $categoria) {
            Categoria::create($categoria);
        }

        // Crear recetas de ejemplo
        $recetas = [
            [
                'nombre' => 'Tortilla de Patatas',
                'descripcion' => "Ingredientes:\n- 4 huevos\n- 2 patatas medianas\n- 1 cebolla\n- Aceite de oliva\n- Sal\n\nPreparación:\n1. Pelar y cortar las patatas en rodajas finas.\n2. Cortar la cebolla en juliana.\n3. Freír las patatas y cebolla en aceite abundante hasta que estén tiernas.\n4. Batir los huevos en un bol grande y añadir las patatas y cebolla escurridas.\n5. Cocinar en una sartén antiadherente hasta que cuaje por ambos lados.",
                'categoria_id' => 2,
                'imagen' => 'recetas/tortilla.jpg' // Necesitarías tener esta imagen en storage/app/public/recetas
            ],
            [
                'nombre' => 'Pancakes de Avena',
                'descripcion' => "Ingredientes:\n- 1 taza de avena\n- 1 plátano maduro\n- 1 huevo\n- 1/2 cucharadita de canela\n- 1 cucharadita de esencia de vainilla\n\nPreparación:\n1. Mezclar todos los ingredientes en una licuadora hasta obtener una mezcla homogénea.\n2. Cocinar en una sartén antiadherente a fuego medio hasta que aparezcan burbujas en la superficie.\n3. Dar vuelta y cocinar por el otro lado.",
                'categoria_id' => 1,
                'imagen' => 'recetas/pancakes.jpg'
            ]
        ];

        foreach ($recetas as $receta) {
            Receta::create($receta);
        }
    }
}
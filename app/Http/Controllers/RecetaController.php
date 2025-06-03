<?php
namespace App\Http\Controllers;

use App\Models\Receta;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RecetaController extends Controller
{
    public function index()
    {
        $recetas = Receta::with('categoria')->get();
        return view('recetas.index', compact('recetas'));
    }

    public function create()
    {
        $categorias = Categoria::all();
        return view('recetas.create', compact('categorias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|max:255',
            'descripcion' => 'required',
            'imagen' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'categoria_id' => 'required|exists:categorias,id',
        ]);

        $imagenPath = $request->file('imagen')->store('recetas', 'public');

        Receta::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'imagen' => $imagenPath,
            'categoria_id' => $request->categoria_id,
        ]);

        return redirect()->route('recetas.index')
            ->with('success', 'Receta creada exitosamente.');
    }

    public function show(Receta $receta)
    {
        return view('recetas.show', compact('receta'));
    }

    public function edit(Receta $receta)
    {
        $categorias = Categoria::all();
        return view('recetas.edit', compact('receta', 'categorias'));
    }

    public function update(Request $request, Receta $receta)
    {
        $request->validate([
            'nombre' => 'required|max:255',
            'descripcion' => 'required',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'categoria_id' => 'required|exists:categorias,id',
        ]);

        $data = [
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'categoria_id' => $request->categoria_id,
        ];

        if ($request->hasFile('imagen')) {
            // Eliminar imagen anterior
            Storage::disk('public')->delete($receta->imagen);
            
            // Guardar nueva imagen
            $data['imagen'] = $request->file('imagen')->store('recetas', 'public');
        }

        $receta->update($data);

        return redirect()->route('recetas.index')
            ->with('success', 'Receta actualizada exitosamente.');
    }

    public function destroy(Receta $receta)
    {
        Storage::disk('public')->delete($receta->imagen);
        $receta->delete();

        return redirect()->route('recetas.index')
            ->with('success', 'Receta eliminada exitosamente.');
    }
}

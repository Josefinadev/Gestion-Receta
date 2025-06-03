@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Encabezado con acciones -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">{{ $categoria->nombre }}</h1>
            <p class="text-indigo-600 mt-1">{{ $categoria->recetas->count() }} recetas en esta categoría</p>
        </div>
        <div class="flex space-x-3">
            <a href="{{ route('categorias.edit', $categoria) }}" 
               class="inline-flex items-center px-4 py-2 bg-white border border-indigo-600 rounded-md shadow-sm text-sm font-medium text-indigo-600 hover:bg-indigo-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                </svg>
                Editar
            </a>
            <form action="{{ route('categorias.destroy', $categoria) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" 
                        class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md shadow-sm text-sm font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors"
                        onclick="return confirm('¿Estás seguro de eliminar esta categoría?')">
                    <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                    </svg>
                    Eliminar
                </button>
            </form>
        </div>
    </div>

    <!-- Descripción -->
    <div class="bg-indigo-50 rounded-lg p-6 mb-8">
        <h2 class="text-lg font-semibold text-gray-900 mb-3">Descripción</h2>
        <p class="text-gray-700 leading-relaxed">{{ $categoria->descripcion ?? 'Esta categoría no tiene descripción.' }}</p>
    </div>

    <!-- Recetas -->
    <div class="mb-8">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-semibold text-gray-900">Recetas</h2>
            <a href="{{ route('recetas.create') }}" class="text-sm text-indigo-600 hover:text-indigo-800 font-medium">
                + Añadir nueva receta
            </a>
        </div>

        @if($categoria->recetas->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($categoria->recetas as $receta)
                    <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-shadow">
                        <div class="p-5">
                            <div class="flex justify-between items-start">
                                <h3 class="font-bold text-lg text-gray-900 mb-2">{{ $receta->nombre }}</h3>
                                <span class="inline-block bg-indigo-100 text-indigo-800 text-xs px-2 py-1 rounded-full">
                                    {{ $receta->dificultad }}
                                </span>
                            </div>
                            <p class="text-gray-600 text-sm mb-4">{{ Str::limit($receta->descripcion, 80) }}</p>
                            <div class="flex justify-between items-center">
                                <span class="text-xs text-gray-500">{{ $receta->tiempo_preparacion }} min</span>
                                <a href="{{ route('recetas.show', $receta) }}" 
                                   class="text-indigo-600 hover:text-indigo-800 text-sm font-medium flex items-center">
                                    Ver receta
                                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="bg-white rounded-lg shadow-sm p-8 text-center">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                <h3 class="mt-2 text-lg font-medium text-gray-900">No hay recetas</h3>
                <p class="mt-1 text-gray-500">Aún no hay recetas en esta categoría.</p>
                <div class="mt-6">
                    <a href="{{ route('recetas.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md shadow-sm text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Crear primera receta
                    </a>
                </div>
            </div>
        @endif
    </div>

    <!-- Volver -->
    <div class="border-t border-gray-200 pt-6">
        <a href="{{ route('categorias.index') }}" class="inline-flex items-center text-indigo-600 hover:text-indigo-900">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Volver a todas las categorías
        </a>
    </div>
</div>
@endsection
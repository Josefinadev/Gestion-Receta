@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto bg-white rounded-lg shadow-md overflow-hidden">
    <div class="md:flex">
        <div class="md:flex-shrink-0 md:w-1/2 flex items-center justify-center p-4">
        <div class="w-full max-w-xs aspect-square overflow-hidden rounded-lg shadow-md">
            <img class="h-full w-full object-cover" src="{{ asset('storage/' . $receta->imagen) }}" alt="{{ $receta->nombre }}">
        </div>
    </div>
        <div class="p-8 md:w-1/2">
            <div class="flex justify-between items-start">
                <div>
                    <span class="inline-block bg-indigo-100 text-indigo-800 text-xs px-2 py-1 rounded-full uppercase tracking-wide font-semibold">
                        {{ $receta->categoria->nombre }}
                    </span>
                    <h1 class="mt-2 text-2xl font-bold text-gray-800">{{ $receta->nombre }}</h1>
                </div>
                <div class="flex space-x-2">
                    <a href="{{ route('recetas.edit', $receta) }}" class="text-indigo-600 hover:text-indigo-900">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                        </svg>
                    </a>
                    <form action="{{ route('recetas.destroy', $receta) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('¿Estás seguro de eliminar esta receta?')">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </form>
                </div>
            </div>

            <div class="mt-6">
                <h2 class="text-lg font-medium text-gray-900 mb-2">Descripción</h2>
                <p class="text-gray-600 whitespace-pre-line">{{ $receta->descripcion }}</p>
            </div>

            <div class="mt-8">
                <a href="{{ route('recetas.index') }}" class="text-indigo-600 hover:text-indigo-900">← Volver a todas las recetas</a>
            </div>
        </div>
    </div>
</div>
@endsection
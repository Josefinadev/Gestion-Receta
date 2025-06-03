@extends('layouts.app')

@section('content')
<div class="flex justify-between items-center mb-6 px-4 py-4 ">
    <h1 class="text-3xl font-extrabold text-gray-900">Recetas</h1>
    <a href="{{ route('recetas.create') }}" 
       class="bg-blue-600 margin:px-60 hover:bg-blue-700 text-white font-semibold py-2 px-10 rounded-full shadow-lg transition duration-30">
       Nueva Receta
    </a>
</div>

<!-- Contenedor con borde y padding -->
<div class="border border-gray-300 rounded-lg shadow-md p-6 mx-4 mx-auto max-w-7xl">
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
        @foreach($recetas as $receta)
        <article class="bg-white rounded-xl shadow-md overflow-hidden flex flex-col hover:shadow-xl transition-shadow duration-300">
            <figure class="relative h-48 overflow-hidden rounded-t-xl">
                <img src="{{ asset('storage/' . $receta->imagen) }}" alt="{{ $receta->nombre }}" class="w-full h-full object-cover transform transition-transform duration-500 hover:scale-105">
                <figcaption class="absolute top-4 left-4 bg-red-500 text-white uppercase text-xs font-bold px-3 py-1 rounded-full shadow-md">
                    {{ $receta->categoria->nombre }}
                </figcaption>
            </figure>
            <div class="p-6 flex flex-col flex-grow">
                <header class="flex justify-between items-start mb-4">
                    <h2 class="text-xl font-bold text-gray-800">{{ $receta->nombre }}</h2>
                    <div class="flex space-x-3">
                        <a href="{{ route('recetas.edit', $receta) }}" title="Editar" class="text-gray-500 hover:text-blue-600 transition-colors">
                            <!-- SVG editar -->
                        </a>
                        <form action="{{ route('recetas.destroy', $receta) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar esta receta?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" title="Eliminar" class="text-gray-500 hover:text-red-600 transition-colors">
                                <!-- SVG eliminar -->
                            </button>
                        </form>
                    </div>
                </header>
                <p class="text-gray-600 flex-grow leading-relaxed">{{ Str::limit($receta->descripcion, 100) }}</p>
                <footer class="mt-6 text-right">
                    <a href="{{ route('recetas.show', $receta) }}" class="text-blue-600 hover:text-blue-800 font-semibold transition-colors">
                        Ver receta →
                    </a>
                </footer>
            </div>
        </article>
        @endforeach
    </div>
</div>
@endsection


<style>
    .cards-container {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
  gap: 2.5rem;
  padding: 1rem;
}

.card-recipe {
  background: linear-gradient(135deg, #f9f9f9 0%, #ffffff 100%);
  border-radius: 16px;
  box-shadow: 0 12px 25px rgba(0, 0, 0, 0.12);
  overflow: hidden;
  display: flex;
  flex-direction: column;
  transition: transform 0.3s ease, box-shadow 0.3s ease;
  cursor: pointer;
}

.card-recipe:hover {
  transform: translateY(-8px);
  box-shadow: 0 20px 40px rgba(0, 0, 0, 0.18);
}

.card-image {
  position: relative;
  height: 200px;
  overflow: hidden;
  border-bottom-left-radius: 16px;
  border-bottom-right-radius: 16px;
}

.card-image img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: scale 0.4s ease;
}

.card-recipe:hover .card-image img {
  transform: scale(1.1);
}

.category-badge {
  position: absolute;
  top: 16px;
  left: 16px;
  background: #ff4757;
  color: white;
  padding: 0.4rem 1rem;
  border-radius: 50px;
  font-weight: 700;
  font-size: 0.8rem;
  letter-spacing: 1.2px;
  text-transform: uppercase;
  box-shadow: 0 2px 6px rgba(255, 71, 87, 0.6);
}

.card-body {
  padding: 24px 28px 32px;
  display: flex;
  flex-direction: column;
  flex-grow: 1;
  gap: 18px;
}

.card-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  gap: 1rem;
}

.card-title {
  font-size: 1.6rem;
  font-weight: 800;
  color: #222;
  margin: 0;
  flex-grow: 1;
  letter-spacing: 0.6px;
}

.actions {
  display: flex;
  gap: 12px;
}

.action-edit,
.action-delete {
  background: transparent;
  border: none;
  color: #777;
  font-size: 1.4rem;
  transition: color 0.3s ease;
}

.action-edit:hover {
  color: #1e90ff;
}

.action-delete:hover {
  color: #ff4757;
}

.card-description {
  font-size: 1rem;
  line-height: 1.7;
  color: #444;
  letter-spacing: 0.3px;
  margin: 0;
  flex-grow: 1;
}

.card-footer {
  text-align: right;
}

.btn-view {
  font-weight: 700;
  color: #ff4757;
  text-decoration: none;
  font-size: 1rem;
  letter-spacing: 0.8px;
  transition: color 0.3s ease;
}

.btn-view:hover {
  color: #ff6b81;
  text-decoration: underline;
}

</style>
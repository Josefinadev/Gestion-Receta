<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Gestión de Recetas | ChefMaster</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="{{ asset('build/assets/app.css') }}" rel="stylesheet">

</head>
<body class="bg-gray-50 text-gray-800 font-sans antialiased">

    <div class="min-h-screen flex flex-col">
        <nav class="bg-white border-b border-gray-200 sticky top-0 z-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16 items-center">
                    <div class="flex items-center space-x-4">
                        <div class="flex items-center">
                            <span class="text-2xl font-bold text-indigo-600 flex items-center">
                                <i class="fas fa-utensils mr-2"></i> RecetasCool
                            </span>
                            <span class="ml-2 text-sm text-gray-500 hidden md:inline">ChefGrados</span>
                        </div>
                        <div class="hidden md:flex space-x-6 ml-10">
                            <a href="{{ route('recetas.index') }}" class="inline-flex items-center px-1 pt-1 border-b-2 border-indigo-500 text-sm font-medium leading-5 text-indigo-600 focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out">
                                <i class="fas fa-book-open mr-2"></i> Recetas
                            </a>
                            <a href="{{ route('categorias.index') }}" class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                                <i class="fas fa-tags mr-2"></i> Categorías
                            </a>
                        </div>
                    </div>
                    <div class="flex items-center">
                    <div class="relative">
                        <button id="admin-toggle" class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 focus:outline-none transition duration-150 ease-in-out">
                            <img class="h-8 w-8 rounded-full object-cover" src="https://ui-avatars.com/api/?name=Admin&background=6366f1&color=fff" alt="Usuario">
                            <span class="ml-2 hidden md:inline">Administrador</span>
                            <i class="fas fa-chevron-down ml-1 text-xs"></i>
                        </button>
                        
                        <!-- Menú desplegable -->
                        <div id="admin-menu" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50">
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Registrarse</a>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Iniciar sesión</a>
                        </div>
                    </div>
                </div>
                </div>
            </div>
            
            <!-- Mobile menu -->
            <div class="md:hidden bg-white border-t border-gray-200">
                <div class="px-2 pt-2 pb-3 space-y-1">
                    <a href="{{ route('recetas.index') }}" class="block px-3 py-2 rounded-md text-base font-medium text-indigo-700 bg-indigo-50">
                        <i class="fas fa-book-open mr-2"></i> Recetas
                    </a>
                    <a href="{{ route('categorias.index') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-50">
                        <i class="fas fa-tags mr-2"></i> Categorías
                    </a>
                </div>
            </div>
        </nav>

        <!-- Contenido principal mejorado -->
        <main class="flex-grow py-8">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Header del contenido -->
                <div class="mb-8 flex flex-col md:flex-row md:items-center md:justify-between">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">
                            @yield('title', 'Panel de Control')
                        </h1>
                        <p class="mt-1 text-sm text-gray-500">
                            @yield('subtitle', 'Gestión profesional de recetas culinarias')
                        </p>
                    </div>
                    <div class="mt-4 md:mt-0">
                        @yield('header-actions')
                    </div>
                </div>

                <!-- Notificaciones -->
                @if(session('success'))
                    <div class="mb-8 p-4 bg-green-50 border-l-4 border-green-500 rounded-lg shadow-sm">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <i class="fas fa-check-circle h-5 w-5 text-green-500"></i>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-green-800">
                                    {{ session('success') }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endif

                @if($errors->any())
                    <div class="mb-8 p-4 bg-red-50 border-l-4 border-red-500 rounded-lg shadow-sm">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <i class="fas fa-exclamation-circle h-5 w-5 text-red-500"></i>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-red-800">
                                    Hay {{ $errors->count() }} error(es) en el formulario
                                </h3>
                                <div class="mt-2 text-sm text-red-700">
                                    <ul class="list-disc pl-5 space-y-1">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Renderizado dinámico -->
                <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                    @yield('content')
                </div>
            </div>
        </main>

        <!-- Footer mejorado -->
        <footer class="bg-white border-t border-gray-200 mt-12">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <div class="flex items-center">
                        <i class="fas fa-utensils text-indigo-600 mr-2"></i>
                        <span class="text-sm font-medium text-gray-900">RecetasCool Pro</span>
                    </div>
                    <div class="mt-4 md:mt-0">
                        <p class="text-sm text-gray-500">
                            © {{ date('Y') }} Sistema profesional de gestión culinaria. Todos los derechos reservados.
                        </p>
                    </div>
                    <div class="mt-4 md:mt-0 flex space-x-6">
                        <a href="#" class="text-gray-400 hover:text-gray-500">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-gray-500">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-gray-500">
                            <i class="fab fa-twitter"></i>
                        </a>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    
    <!-- Scripts adicionales -->
    <script>
        // Puedes añadir interactividad aquí
        document.addEventListener('DOMContentLoaded', function() {
            // Ejemplo: Confirmación antes de eliminar
            const deleteButtons = document.querySelectorAll('.delete-btn');
            deleteButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    if (!confirm('¿Estás seguro de que deseas eliminar este elemento?')) {
                        e.preventDefault();
                    }
                });
            });
        });

        document.getElementById('admin-toggle').addEventListener('click', function(e) {
    e.stopPropagation(); // Evita que el evento se propague
    const menu = document.getElementById('admin-menu');
    menu.classList.toggle('hidden');
});

    // Cerrar el menú al hacer clic fuera de él
    document.addEventListener('click', function(e) {
        const menu = document.getElementById('admin-menu');
        const toggle = document.getElementById('admin-toggle');
        
        if (!toggle.contains(e.target) && !menu.contains(e.target)) {
            menu.classList.add('hidden');
        }
    });
    </script>
    
</body>
</html>
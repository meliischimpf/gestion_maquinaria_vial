<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>MaquinariaVial - Sistema de Gestión de Maquinaria</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <!-- Styles / Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100 antialiased">
        <!-- Navigation -->
        <nav class="glass-nav sticky top-0 z-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 bg-gradient-to-br from-orange-500 to-red-500 rounded-lg flex items-center justify-center">
                                <i class="fas fa-hard-hat text-white text-lg"></i>
                            </div>
                            <div>
                                <h1 class="text-xl font-bold bg-gradient-to-r from-orange-500 to-red-500 bg-clip-text text-transparent">
                                    MaquinariaVial
                                </h1>
                                <p class="text-xs text-gray-600 dark:text-gray-400 -mt-1">Sistema de Gestión</p>
                            </div>
                        </div>
                    </div>

                    @if (Route::has('login'))
                        <div class="flex items-center space-x-4">
                            @auth
                                <a href="{{ url('/dashboard') }}" class="action-btn inline-flex items-center px-4 py-2 bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 border border-transparent rounded-lg font-semibold text-sm text-white transition duration-300">
                                    <i class="fas fa-tachometer-alt mr-2"></i>
                                    Dashboard
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="text-gray-700 dark:text-gray-300 hover:text-blue-500 dark:hover:text-blue-400 px-3 py-2 rounded-md text-sm font-medium transition duration-300">
                                    <i class="fas fa-sign-in-alt mr-1"></i>
                                    Iniciar Sesión
                                </a>

                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="action-btn inline-flex items-center px-4 py-2 bg-gradient-to-r from-orange-500 to-red-500 hover:from-orange-600 hover:to-red-600 border border-transparent rounded-lg font-semibold text-sm text-white transition duration-300">
                                        <i class="fas fa-user-plus mr-2"></i>
                                        Registrarse
                                    </a>
                                @endif
                            @endauth
                        </div>
                    @endif
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <section class="hero-construction min-h-screen flex items-center justify-center relative">
            <div class="hero-overlay absolute inset-0"></div>
            <div class="relative z-10 text-center text-white px-6 max-w-5xl mx-auto">
                <div class="animate-fadeInUp">
                    <h1 class="text-5xl md:text-7xl font-bold mb-6 leading-tight">
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-400 via-red-500 to-pink-500"> 
                            Gestión Inteligente
                        </span>
                        <br>
                        <span class="text-white">
                            de Maquinaria Vial
                        </span>
                    </h1>
                    <p class="text-xl md:text-2xl mb-8 text-gray-200 max-w-3xl mx-auto leading-relaxed">
                        Optimiza tu flota, controla mantenimientos y maximiza la eficiencia de tus proyectos de construcción con nuestra plataforma integral.
                    </p>
                    <div class="flex flex-col md:flex-row gap-6 justify-center">
                        @guest
                            <a href="{{ route('register') }}" class="action-btn px-8 py-4 bg-gradient-to-r from-orange-500 to-red-500 hover:from-orange-600 hover:to-red-600 text-white font-bold text-lg rounded-lg shadow-xl transform hover:scale-105 transition duration-300">
                                <i class="fas fa-rocket mr-3"></i>
                                Comenzar Ahora
                            </a>
                            <a href="{{ route('login') }}" class="action-btn px-8 py-4 bg-white bg-opacity-20 hover:bg-opacity-30 border-2 border-white text-white font-bold text-lg rounded-lg backdrop-blur-sm transform hover:scale-105 transition duration-300">
                                <i class="fas fa-sign-in-alt mr-3"></i>
                                Acceder al Sistema
                            </a>
                        @else
                            <a href="{{ route('dashboard') }}" class="action-btn px-8 py-4 bg-gradient-to-r from-blue-500 to-purple-500 hover:from-blue-600 hover:to-purple-600 text-white font-bold text-lg rounded-lg shadow-xl transform hover:scale-105 transition duration-300">
                                <i class="fas fa-tachometer-alt mr-3"></i>
                                Ir al Dashboard
                            </a>
                        @endguest
                    </div>
                </div>
            </div>

            <!-- Scroll Indicator -->
            <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 text-white animate-bounce">
                <i class="fas fa-chevron-down text-2xl"></i>
            </div>
        </section>

        <!-- Features Section -->
        <section class="py-20 bg-white dark:bg-gray-800">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-4xl font-bold text-gray-900 dark:text-gray-100 mb-4">
                        Características Principales
                    </h2>
                    <p class="text-xl text-gray-600 dark:text-gray-400 max-w-3xl mx-auto">
                        Descubre cómo nuestro sistema puede transformar la gestión de tu maquinaria y proyectos de construcción.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <!-- Feature 1 -->
                    <div class="machine-card bg-white dark:bg-gray-700 p-8 rounded-xl shadow-lg text-center professional-shadow">
                        <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-full flex items-center justify-center mx-auto mb-6">
                            <i class="fas fa-truck-moving text-white text-2xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-4">
                            Gestión de Flota
                        </h3>
                        <p class="text-gray-600 dark:text-gray-400 leading-relaxed">
                            Administra toda tu maquinaria desde un solo lugar. Control de inventario, estado operativo y especificaciones técnicas.
                        </p>
                    </div>

                    <!-- Feature 2 -->
                    <div class="machine-card bg-white dark:bg-gray-700 p-8 rounded-xl shadow-lg text-center professional-shadow">
                        <div class="w-16 h-16 bg-gradient-to-br from-yellow-500 to-orange-500 rounded-full flex items-center justify-center mx-auto mb-6">
                            <i class="fas fa-wrench text-white text-2xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-4">
                            Mantenimiento Predictivo
                        </h3>
                        <p class="text-gray-600 dark:text-gray-400 leading-relaxed">
                            Programa y rastrea mantenimientos preventivos. Reduce costos operativos y extiende la vida útil de tus equipos.
                        </p>
                    </div>

                    <!-- Feature 3 -->
                    <div class="machine-card bg-white dark:bg-gray-700 p-8 rounded-xl shadow-lg text-center professional-shadow">
                        <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-teal-500 rounded-full flex items-center justify-center mx-auto mb-6">
                            <i class="fas fa-building text-white text-2xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-4">
                            Control de Proyectos
                        </h3>
                        <p class="text-gray-600 dark:text-gray-400 leading-relaxed">
                            Supervisa obras y proyectos en tiempo real. Asigna recursos eficientemente y monitorea el progreso.
                        </p>
                    </div>

                    <!-- Feature 4 -->
                    <div class="machine-card bg-white dark:bg-gray-700 p-8 rounded-xl shadow-lg text-center professional-shadow">
                        <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-pink-500 rounded-full flex items-center justify-center mx-auto mb-6">
                            <i class="fas fa-chart-line text-white text-2xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-4">
                            Análisis Avanzado
                        </h3>
                        <p class="text-gray-600 dark:text-gray-400 leading-relaxed">
                            Reportes detallados y métricas de rendimiento. Toma decisiones informadas basadas en datos reales.
                        </p>
                    </div>

                    <!-- Feature 5 -->
                    <div class="machine-card bg-white dark:bg-gray-700 p-8 rounded-xl shadow-lg text-center professional-shadow">
                        <div class="w-16 h-16 bg-gradient-to-br from-red-500 to-pink-500 rounded-full flex items-center justify-center mx-auto mb-6">
                            <i class="fas fa-mobile-alt text-white text-2xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-4">
                            Acceso Móvil
                        </h3>
                        <p class="text-gray-600 dark:text-gray-400 leading-relaxed">
                            Interface responsiva que se adapta a cualquier dispositivo. Gestiona tu flota desde cualquier lugar.
                        </p>
                    </div>

                    <!-- Feature 6 -->
                    <div class="machine-card bg-white dark:bg-gray-700 p-8 rounded-xl shadow-lg text-center professional-shadow">
                        <div class="w-16 h-16 bg-gradient-to-br from-indigo-500 to-blue-500 rounded-full flex items-center justify-center mx-auto mb-6">
                            <i class="fas fa-shield-alt text-white text-2xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-4">
                            Seguridad Garantizada
                        </h3>
                        <p class="text-gray-600 dark:text-gray-400 leading-relaxed">
                            Protección de datos empresariales con encriptación avanzada y copias de seguridad automáticas.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Stats Section -->
        <section class="py-20 machinery-pattern">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h2 class="text-4xl font-bold text-gray-900 dark:text-gray-100 mb-16">
                    Optimiza tu Operación
                </h2>
                
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                    <div class="stat-card text-center">
                        <div class="text-5xl font-bold text-blue-600 dark:text-blue-400 mb-2">95%</div>
                        <div class="text-lg text-gray-600 dark:text-gray-400">Eficiencia Operativa</div>
                    </div>
                    <div class="stat-card text-center">
                        <div class="text-5xl font-bold text-green-600 dark:text-green-400 mb-2">40%</div>
                        <div class="text-lg text-gray-600 dark:text-gray-400">Reducción de Costos</div>
                    </div>
                    <div class="stat-card text-center">
                        <div class="text-5xl font-bold text-orange-600 dark:text-orange-400 mb-2">24/7</div>
                        <div class="text-lg text-gray-600 dark:text-gray-400">Monitoreo Continuo</div>
                    </div>
                    <div class="stat-card text-center">
                        <div class="text-5xl font-bold text-purple-600 dark:text-purple-400 mb-2">100%</div>
                        <div class="text-lg text-gray-600 dark:text-gray-400">Trazabilidad</div>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="py-20 bg-gradient-to-r from-orange-500 to-red-500 text-white">
            <div class="max-w-4xl mx-auto text-center px-4 sm:px-6 lg:px-8">
                <h2 class="text-4xl md:text-5xl font-bold mb-6">
                    ¿Listo para Revolucionar tu Gestión?
                </h2>
                <p class="text-xl mb-8 opacity-90">
                    Únete a empresas líderes que ya confían en MaquinariaVial para optimizar sus operaciones.
                </p>
                @guest
                    <a href="{{ route('register') }}" class="action-btn inline-flex items-center px-8 py-4 bg-white text-orange-500 hover:text-orange-600 font-bold text-lg rounded-lg shadow-xl transform hover:scale-105 transition duration-300">
                        <i class="fas fa-rocket mr-3"></i>
                        Comenzar Gratis Ahora
                    </a>
                @else
                    <a href="{{ route('dashboard') }}" class="action-btn inline-flex items-center px-8 py-4 bg-white text-blue-500 hover:text-blue-600 font-bold text-lg rounded-lg shadow-xl transform hover:scale-105 transition duration-300">
                        <i class="fas fa-tachometer-alt mr-3"></i>
                        Acceder al Dashboard
                    </a>
                @endguest
            </div>
        </section>

        <!-- Footer -->
        <footer class="bg-gray-900 text-white py-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                    <div class="col-span-1 md:col-span-2">
                        <div class="flex items-center space-x-3 mb-4">
                            <div class="w-10 h-10 bg-gradient-to-br from-orange-500 to-red-500 rounded-lg flex items-center justify-center">
                                <i class="fas fa-hard-hat text-white text-lg"></i>
                            </div>
                            <div>
                                <h1 class="text-xl font-bold">MaquinariaVial</h1>
                                <p class="text-xs text-gray-400">Sistema de Gestión</p>
                            </div>
                        </div>
                        <p class="text-gray-400 mb-4 max-w-md">
                            La solución integral para la gestión de maquinaria vial y proyectos de construcción. Optimiza tu operación con tecnología de vanguardia.
                        </p>
                    </div>
                    
                    <div>
                        <h3 class="text-lg font-semibold mb-4">Características</h3>
                        <ul class="space-y-2 text-gray-400">
                            <li><i class="fas fa-check mr-2 text-green-400"></i>Gestión de Flota</li>
                            <li><i class="fas fa-check mr-2 text-green-400"></i>Mantenimiento</li>
                            <li><i class="fas fa-check mr-2 text-green-400"></i>Control de Proyectos</li>
                            <li><i class="fas fa-check mr-2 text-green-400"></i>Reportes Avanzados</li>
                        </ul>
                    </div>
                    
                    <div>
                        <h3 class="text-lg font-semibold mb-4">Contacto</h3>
                        <ul class="space-y-2 text-gray-400">
                            <li><i class="fas fa-envelope mr-2"></i>info@maquinariavial.com</li>
                            <li><i class="fas fa-phone mr-2"></i>+54 900 123 456</li>
                            <li><i class="fas fa-map-marker-alt mr-2"></i>Entre Ríos, Argentina</li>
                        </ul>
                    </div>
                </div>
                
                <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-400">
                    <p>&copy; {{ date('Y') }} MaquinariaVial. Todos los derechos reservados.</p>
                </div>
            </div>
        </footer>

        <style>
            @keyframes fadeInUp {
                from {
                    opacity: 0;
                    transform: translateY(30px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            .animate-fadeInUp {
                animation: fadeInUp 1s ease-out;
            }
        </style>
    </body>
</html>

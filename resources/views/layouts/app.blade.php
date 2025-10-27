<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>@yield('title', 'Portfolio Profissional')</title>
    <meta name="description" content="@yield('description', 'Portfolio profissional de desenvolvimento web e aplicações. Criação de sites, sistemas e aplicativos modernos.')">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700,800&display=swap" rel="stylesheet" />
    
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Additional Styles -->
    @stack('styles')
 
  <script src="https://www.google.com/recaptcha/enterprise.js?render=6LdTKtgrAAAAALFMQ-lGb8_1vrabbDBNgpZUfHN6"></script>
 
</head>
</head>
<body class="font-sans antialiased bg-gray-50 text-gray-900">
    <!-- Navigation -->
    <nav class="bg-white shadow-sm border-b border-gray-100 sticky top-0 z-50 transition-all duration-300" id="navbar">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <!-- Logo -->
                    <a href="{{ route('home') }}" class="flex items-center space-x-2">
                        <div class="w-8 h-8 bg-gradient-to-r from-blue-600 to-purple-600 rounded-lg flex items-center justify-center">
                            <span class="text-white font-bold text-sm">P</span>
                        </div>
                        <span class="font-bold text-xl text-gray-900">Portfólio Profissional</span>
                    </a>
                </div>
                
                <!-- Desktop Navigation -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">
                        Início
                    </a>
                    <a href="{{ route('about') }}" class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}">
                        Sobre
                    </a>
                    <a href="{{ route('services') }}" class="nav-link {{ request()->routeIs('services') ? 'active' : '' }}">
                        Serviços
                    </a>
                    <a href="{{ route('portfolio.index') }}" class="nav-link {{ request()->routeIs('portfolio.*') ? 'active' : '' }}">
                        Portfolio
                    </a>
                    <a href="{{ route('blog.index') }}" class="nav-link {{ request()->routeIs('blog.*') ? 'active' : '' }}">
                        Blog
                    </a>
                    <a href="{{ route('contact.index') }}" class="nav-link {{ request()->routeIs('contact.*') ? 'active' : '' }}">
                        Contato
                    </a>
                    
                    @auth
                        <a href="{{ route('admin.dashboard') }}" class="nav-link">
                            <i class="fas fa-cog mr-1"></i> Admin
                        </a>
                    @endauth
                </div>
                
                <!-- Mobile menu button -->
                <div class="md:hidden flex items-center">
                    <button type="button" class="mobile-menu-button p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-blue-500">
                        <span class="sr-only">Abrir menu principal</span>
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        
        <!-- Mobile Navigation -->
        <div class="md:hidden mobile-menu hidden">
            <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3 bg-white border-t border-gray-100">
                <a href="{{ route('home') }}" class="mobile-nav-link {{ request()->routeIs('home') ? 'active' : '' }}">
                    Início
                </a>
                <a href="{{ route('about') }}" class="mobile-nav-link {{ request()->routeIs('about') ? 'active' : '' }}">
                    Sobre
                </a>
                <a href="{{ route('services') }}" class="mobile-nav-link {{ request()->routeIs('services') ? 'active' : '' }}">
                    Serviços
                </a>
                <a href="{{ route('portfolio.index') }}" class="mobile-nav-link {{ request()->routeIs('portfolio.*') ? 'active' : '' }}">
                    Portfolio
                </a>
                <a href="{{ route('blog.index') }}" class="mobile-nav-link {{ request()->routeIs('blog.*') ? 'active' : '' }}">
                    Blog
                </a>
                <a href="{{ route('contact.index') }}" class="mobile-nav-link {{ request()->routeIs('contact.*') ? 'active' : '' }}">
                    Contato
                </a>
                
                @auth
                    <a href="{{ route('admin.dashboard') }}" class="mobile-nav-link">
                        <i class="fas fa-cog mr-1"></i> Admin
                    </a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="min-h-screen">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <!-- Brand -->
                <div class="col-span-1 md:col-span-2">
                    <div class="flex items-center space-x-2 mb-4">
                        <div class="w-8 h-8 bg-gradient-to-r from-blue-600 to-purple-600 rounded-lg flex items-center justify-center">
                            <span class="text-white font-bold text-sm">P</span>
                        </div>
                        <span class="font-bold text-xl">Portfolio</span>
                    </div>
                    <p class="text-gray-400 mb-4 max-w-md">
                        Desenvolvedor especializado em criar soluções web modernas e eficientes. 
                        Transformo ideias em realidade digital.
                    </p>
                    
                    <!-- Social Links -->
                    <div class="flex space-x-4">
                        <a href="https://www.linkedin.com/in/rafaelcacote" class="social-link" aria-label="LinkedIn">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a href="https://github.com/rafaelcacote" class="social-link" aria-label="GitHub">
                            <i class="fab fa-github"></i>
                        </a>
                        <a href="https://wa.me/5592992684391" class="social-link" aria-label="WhatsApp">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                        <a href="mailto:rafael.cacote@gmail.com" class="social-link" aria-label="Email">
                            <i class="fas fa-envelope"></i>
                        </a>
                    </div>
                </div>
                
                <!-- Quick Links -->
                <div>
                    <h3 class="font-semibold text-lg mb-4">Links Rápidos</h3>
                    <ul class="space-y-2">
                        <li><a href="{{ route('home') }}" class="footer-link">Início</a></li>
                        <li><a href="{{ route('about') }}" class="footer-link">Sobre</a></li>
                        <li><a href="{{ route('services') }}" class="footer-link">Serviços</a></li>
                        <li><a href="{{ route('portfolio.index') }}" class="footer-link">Portfolio</a></li>
                        <li><a href="{{ route('blog.index') }}" class="footer-link">Blog</a></li>
                        <li><a href="{{ route('contact.index') }}" class="footer-link">Contato</a></li>
                    </ul>
                </div>
                
                <!-- Contact Info -->
                <div>
                    <h3 class="font-semibold text-lg mb-4">Contato</h3>
                    <ul class="space-y-2">
                        <li class="flex items-center">
                            <i class="fas fa-envelope w-5 h-5 mr-2 text-gray-400"></i>
                            <span class="text-gray-400">rafael.cacote@gmail.com</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-phone w-5 h-5 mr-2 text-gray-400"></i>
                            <span class="text-gray-400">(92) 99268-4391</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-map-marker-alt w-5 h-5 mr-2 text-gray-400"></i>
                            <span class="text-gray-400">Manaus, AM</span>
                        </li>
                    </ul>
                </div>
            </div>
            
            <div class="border-t border-gray-800 mt-8 pt-8 text-center">
                <p class="text-gray-400">
                    &copy; {{ date('Y') }} Portfolio Profissional. Todos os direitos reservados.
                </p>
            </div>
        </div>
    </footer>

    <!-- reCAPTCHA Script -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    
    <!-- Scripts -->
    @stack('scripts')
    
    <script>
        // Mobile menu toggle
        document.querySelector('.mobile-menu-button').addEventListener('click', function() {
            document.querySelector('.mobile-menu').classList.toggle('hidden');
        });
        
        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.getElementById('navbar');
            if (window.scrollY > 10) {
                navbar.classList.add('shadow-md', 'bg-white/95', 'backdrop-blur-sm');
            } else {
                navbar.classList.remove('shadow-md', 'bg-white/95', 'backdrop-blur-sm');
            }
        });
        
        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    </script>
</body>
</html>


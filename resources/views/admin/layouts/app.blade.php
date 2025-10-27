<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Admin') - Portfolio Admin</title>
    <meta name="description" content="@yield('description', 'Área administrativa do portfolio')">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    @stack('styles')
</head>
<body class="font-sans antialiased bg-gray-100">
    <div class="min-h-screen">
        <!-- Sidebar -->
        <aside class="fixed inset-y-0 left-0 z-50 w-64 bg-white shadow-lg transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out" id="sidebar">
            <!-- Logo -->
            <div class="flex items-center justify-center h-16 border-b border-gray-200">
                <h1 class="text-xl font-bold text-gray-900">Portfolio Admin</h1>
            </div>
            
            <!-- Navigation -->
            <nav class="mt-8">
                <div class="px-4 space-y-2">
                    <!-- Dashboard -->
                    <a href="{{ route('admin.dashboard') }}" 
                       class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i class="fas fa-tachometer-alt w-5 h-5"></i>
                        <span>Dashboard</span>
                    </a>
                    
                    <!-- Projects -->
                    <div class="nav-group">
                        <div class="nav-group-header">
                            <i class="fas fa-laptop-code w-5 h-5"></i>
                            <span>Projetos</span>
                        </div>
                        <div class="nav-group-items">
                            <a href="{{ route('admin.projects.index') }}" 
                               class="nav-sublink {{ request()->routeIs('admin.projects.*') ? 'active' : '' }}">
                                <i class="fas fa-list w-4 h-4"></i>
                                <span>Todos os Projetos</span>
                            </a>
                            <a href="{{ route('admin.projects.create') }}" 
                               class="nav-sublink">
                                <i class="fas fa-plus w-4 h-4"></i>
                                <span>Novo Projeto</span>
                            </a>
                        </div>
                    </div>
                    
                    <!-- Blog -->
                    <div class="nav-group">
                        <div class="nav-group-header">
                            <i class="fas fa-newspaper w-5 h-5"></i>
                            <span>Blog</span>
                        </div>
                        <div class="nav-group-items">
                            <a href="{{ route('admin.blog.index') }}" 
                               class="nav-sublink {{ request()->routeIs('admin.blog.*') ? 'active' : '' }}">
                                <i class="fas fa-list w-4 h-4"></i>
                                <span>Todos os Posts</span>
                            </a>
                            <a href="{{ route('admin.blog.create') }}" 
                               class="nav-sublink">
                                <i class="fas fa-plus w-4 h-4"></i>
                                <span>Novo Post</span>
                            </a>
                        </div>
                    </div>
                    
                    <!-- Messages -->
                    <a href="{{ route('admin.messages.index') }}" 
                       class="nav-link {{ request()->routeIs('admin.messages.*') ? 'active' : '' }}">
                        <i class="fas fa-envelope w-5 h-5"></i>
                        <span>Mensagens</span>
                        @if($unreadCount = \App\Models\ContactMessage::unread()->count())
                        <span class="ml-auto bg-red-500 text-white text-xs px-2 py-1 rounded-full">{{ $unreadCount }}</span>
                        @endif
                    </a>
                    
                    <!-- Divider -->
                    <div class="border-t border-gray-200 my-4"></div>
                    
                    <!-- View Site -->
                    <a href="{{ route('home') }}" 
                       target="_blank"
                       class="nav-link">
                        <i class="fas fa-external-link-alt w-5 h-5"></i>
                        <span>Ver Site</span>
                    </a>
                    
                    <!-- Logout -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="nav-link w-full text-left text-red-600 hover:bg-red-50">
                            <i class="fas fa-sign-out-alt w-5 h-5"></i>
                            <span>Sair</span>
                        </button>
                    </form>
                </div>
            </nav>
        </aside>
        
        <!-- Main Content -->
        <div class="lg:ml-64">
            <!-- Top Bar -->
            <header class="bg-white shadow-sm border-b border-gray-200">
                <div class="flex items-center justify-between px-6 py-4">
                    <!-- Mobile menu button -->
                    <button class="lg:hidden text-gray-500 hover:text-gray-700" id="mobile-menu-button">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                    
                    <!-- Page Title -->
                    <div class="flex-1 lg:flex-none">
                        <h2 class="text-xl font-semibold text-gray-900">@yield('page-title', 'Dashboard')</h2>
                    </div>
                    
                    <!-- User Menu -->
                    <div class="flex items-center space-x-4">
                        <!-- Notifications -->
                        <div class="relative">
                            <button class="text-gray-500 hover:text-gray-700 relative">
                                <i class="fas fa-bell text-xl"></i>
                                @if($notificationCount = \App\Models\ContactMessage::new()->count())
                                <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs w-5 h-5 rounded-full flex items-center justify-center">
                                    {{ $notificationCount }}
                                </span>
                                @endif
                            </button>
                        </div>
                        
                        <!-- User Info -->
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 bg-blue-600 rounded-full flex items-center justify-center">
                                <i class="fas fa-user text-white text-sm"></i>
                            </div>
                            <div class="hidden sm:block">
                                <div class="text-sm font-medium text-gray-900">{{ Auth::user()->name ?? 'Admin' }}</div>
                                <div class="text-xs text-gray-500">Administrador</div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            
            <!-- Page Content -->
            <main class="p-6">
                <!-- Flash Messages -->
                @if(session('success'))
                <div class="mb-6 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg">
                    <div class="flex items-center">
                        <i class="fas fa-check-circle mr-2"></i>
                        {{ session('success') }}
                    </div>
                </div>
                @endif
                
                @if(session('error'))
                <div class="mb-6 bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg">
                    <div class="flex items-center">
                        <i class="fas fa-exclamation-circle mr-2"></i>
                        {{ session('error') }}
                    </div>
                </div>
                @endif
                
                @yield('content')
            </main>
        </div>
    </div>
    
    <!-- Mobile Sidebar Overlay -->
    <div class="fixed inset-0 z-40 bg-black bg-opacity-50 lg:hidden hidden" id="sidebar-overlay"></div>
    
    @stack('scripts')
    
    <script>
        // Mobile menu toggle
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const sidebar = document.getElementById('sidebar');
        const sidebarOverlay = document.getElementById('sidebar-overlay');
        
        mobileMenuButton.addEventListener('click', () => {
            sidebar.classList.toggle('-translate-x-full');
            sidebarOverlay.classList.toggle('hidden');
        });
        
        sidebarOverlay.addEventListener('click', () => {
            sidebar.classList.add('-translate-x-full');
            sidebarOverlay.classList.add('hidden');
        });
        
        // Nav group toggle
        document.querySelectorAll('.nav-group-header').forEach(header => {
            header.addEventListener('click', () => {
                const items = header.nextElementSibling;
                const isOpen = !items.classList.contains('hidden');
                
                if (isOpen) {
                    items.classList.add('hidden');
                    header.querySelector('i').style.transform = 'rotate(0deg)';
                } else {
                    items.classList.remove('hidden');
                    header.querySelector('i').style.transform = 'rotate(90deg)';
                }
            });
        });
    </script>
</body>
</html>


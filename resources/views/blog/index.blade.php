@extends('layouts.app')

@section('title', 'Blog - Artigos e Dicas de Desenvolvimento')
@section('description', 'Artigos sobre desenvolvimento web, tecnologia, dicas de programação e tendências do mercado.')

@section('content')
<!-- Hero Section -->
<section class="bg-gradient-primary text-white section-padding">
    <div class="container-custom text-center">
        <h1 class="heading-xl text-white mb-6">Blog</h1>
        <p class="text-lead text-blue-100 max-w-3xl mx-auto">
            Compartilho conhecimentos, experiências e dicas sobre desenvolvimento web e tecnologia.
        </p>
    </div>
</section>

<!-- Search and Filters -->
<section class="py-8 bg-white border-b border-gray-100">
    <div class="container-custom">
        <div class="flex flex-col lg:flex-row gap-6 items-center justify-between">
            <!-- Search -->
            <div class="relative flex-1 max-w-md">
                <form method="GET" action="{{ route('blog.index') }}" class="flex">
                    <input type="hidden" name="tag" value="{{ request('tag') }}">
                    <input type="text" 
                           name="search" 
                           value="{{ request('search') }}"
                           placeholder="Buscar artigos..." 
                           class="form-input pr-10 w-full">
                    <button type="submit" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
            </div>
            
            <!-- Tag Filter -->
            <div class="flex flex-wrap gap-2">
                <a href="{{ route('blog.index') }}" 
                   class="filter-btn {{ !request('tag') ? 'active' : '' }}">
                    Todos
                </a>
                @foreach($allTags as $tag)
                <a href="{{ route('blog.index', ['tag' => $tag]) }}" 
                   class="filter-btn {{ request('tag') == $tag ? 'active' : '' }}">
                    {{ $tag }}
                </a>
                @endforeach
            </div>
        </div>
    </div>
</section>

<!-- Featured Posts -->
@if($featuredPosts->count() > 0 && !request('search') && !request('tag'))
<section class="section-padding bg-gray-50">
    <div class="container-custom">
        <h2 class="heading-lg text-center mb-12">Artigos em Destaque</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($featuredPosts as $post)
            <article class="blog-card group">
                <div class="relative overflow-hidden">
                    @if($post->featured_image)
                        <img src="{{ $post->featured_image_url }}" 
                             alt="{{ $post->title }}" 
                             class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300">
                    @else
                        <div class="w-full h-48 bg-gradient-secondary flex items-center justify-center">
                            <i class="fas fa-newspaper text-4xl text-gray-400"></i>
                        </div>
                    @endif
                    
                    <div class="absolute top-4 left-4">
                        <span class="bg-yellow-500 text-white px-3 py-1 rounded-full text-xs font-semibold">
                            <i class="fas fa-star mr-1"></i>Destaque
                        </span>
                    </div>
                </div>
                
                <div class="p-6">
                    <div class="flex items-center text-sm text-gray-500 mb-3">
                        <time datetime="{{ $post->published_at->format('Y-m-d') }}">
                            {{ $post->published_at->format('d/m/Y') }}
                        </time>
                        <span class="mx-2">•</span>
                        <span>{{ $post->reading_time }} min de leitura</span>
                        <span class="mx-2">•</span>
                        <span>{{ $post->views }} visualizações</span>
                    </div>
                    
                    <h3 class="font-bold text-xl mb-3 group-hover:text-blue-600 transition-colors duration-200">
                        <a href="{{ route('blog.show', $post) }}">{{ $post->title }}</a>
                    </h3>
                    
                    <p class="text-gray-600 mb-4 line-clamp-3">{{ $post->excerpt }}</p>
                    
                    @if($post->tags)
                    <div class="flex flex-wrap gap-1 mb-4">
                        @foreach(array_slice($post->tags, 0, 3) as $tag)
                            <span class="tag">{{ $tag }}</span>
                        @endforeach
                    </div>
                    @endif
                    
                    <a href="{{ route('blog.show', $post) }}" 
                       class="text-blue-600 hover:text-blue-800 font-medium text-sm">
                        Ler Artigo Completo <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                </div>
            </article>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- All Posts -->
<section class="section-padding bg-white">
    <div class="container-custom">
        <div class="flex justify-between items-center mb-12">
            <h2 class="heading-lg">
                @if(request('search'))
                    Resultados para "{{ request('search') }}"
                @elseif(request('tag'))
                    Artigos sobre "{{ request('tag') }}"
                @else
                    Todos os Artigos
                @endif
            </h2>
            
            @if($posts->total() > 0)
            <span class="text-gray-500">{{ $posts->total() }} artigo(s) encontrado(s)</span>
            @endif
        </div>
        
        @if($posts->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($posts as $post)
                <article class="blog-card group">
                    <div class="relative overflow-hidden">
                        @if($post->featured_image)
                            <img src="{{ $post->featured_image_url }}" 
                                 alt="{{ $post->title }}" 
                                 class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300">
                        @else
                            <div class="w-full h-48 bg-gradient-secondary flex items-center justify-center">
                                <i class="fas fa-newspaper text-4xl text-gray-400"></i>
                            </div>
                        @endif
                        
                        @if($post->featured)
                        <div class="absolute top-4 left-4">
                            <span class="bg-yellow-500 text-white px-2 py-1 rounded-full text-xs font-medium">
                                <i class="fas fa-star mr-1"></i>Destaque
                            </span>
                        </div>
                        @endif
                    </div>
                    
                    <div class="p-6">
                        <div class="flex items-center text-sm text-gray-500 mb-3">
                            <time datetime="{{ $post->published_at->format('Y-m-d') }}">
                                {{ $post->published_at->format('d/m/Y') }}
                            </time>
                            <span class="mx-2">•</span>
                            <span>{{ $post->reading_time }} min</span>
                            @if($post->views > 0)
                            <span class="mx-2">•</span>
                            <span>{{ $post->views }} views</span>
                            @endif
                        </div>
                        
                        <h3 class="font-bold text-lg mb-2 group-hover:text-blue-600 transition-colors duration-200">
                            <a href="{{ route('blog.show', $post) }}">{{ $post->title }}</a>
                        </h3>
                        
                        <p class="text-gray-600 text-sm mb-4 line-clamp-3">{{ $post->excerpt }}</p>
                        
                        @if($post->tags)
                        <div class="flex flex-wrap gap-1 mb-4">
                            @foreach(array_slice($post->tags, 0, 3) as $tag)
                                <span class="tag">{{ $tag }}</span>
                            @endforeach
                            @if(count($post->tags) > 3)
                                <span class="tag">+{{ count($post->tags) - 3 }}</span>
                            @endif
                        </div>
                        @endif
                        
                        <a href="{{ route('blog.show', $post) }}" 
                           class="text-blue-600 hover:text-blue-800 font-medium text-sm">
                            Ler Mais <i class="fas fa-arrow-right ml-1"></i>
                        </a>
                    </div>
                </article>
                @endforeach
            </div>
            
            <!-- Pagination -->
            @if($posts->hasPages())
            <div class="mt-12">
                {{ $posts->appends(request()->query())->links() }}
            </div>
            @endif
        @else
            <!-- Empty State -->
            <div class="text-center py-16">
                <div class="w-24 h-24 bg-gray-200 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-search text-3xl text-gray-400"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Nenhum artigo encontrado</h3>
                <p class="text-gray-600 mb-6">
                    @if(request('search') || request('tag'))
                        Tente ajustar os filtros ou fazer uma nova busca.
                    @else
                        Em breve novos artigos serão publicados.
                    @endif
                </p>
                @if(request('search') || request('tag'))
                <a href="{{ route('blog.index') }}" class="btn-primary">
                    Ver Todos os Artigos
                </a>
                @endif
            </div>
        @endif
    </div>
</section>

<!-- Newsletter Section -->
<section class="section-padding bg-gray-50">
    <div class="container-custom">
        <div class="max-w-2xl mx-auto text-center">
            <h2 class="heading-lg mb-4">Receba Novos Artigos</h2>
            <p class="text-lead mb-8">
                Inscreva-se para receber notificações sobre novos artigos e dicas exclusivas.
            </p>
            
            <form class="flex flex-col sm:flex-row gap-4 max-w-md mx-auto">
                <input type="email" 
                       placeholder="Seu melhor e-mail" 
                       class="form-input flex-1">
                <button type="submit" class="btn-primary">
                    <i class="fas fa-bell mr-2"></i>
                    Inscrever-se
                </button>
            </form>
            
            <p class="text-sm text-gray-500 mt-4">
                Sem spam. Cancele a qualquer momento.
            </p>
        </div>
    </div>
</section>

<!-- Categories Section -->
<section class="section-padding bg-white">
    <div class="container-custom">
        <div class="text-center mb-12">
            <h2 class="heading-lg mb-4">Categorias Populares</h2>
            <p class="text-lead max-w-3xl mx-auto">
                Explore artigos organizados por temas e tecnologias.
            </p>
        </div>
        
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @php
            $categories = [
                ['name' => 'Laravel', 'count' => 12, 'icon' => 'fab fa-laravel', 'color' => 'text-red-500'],
                ['name' => 'React', 'count' => 8, 'icon' => 'fab fa-react', 'color' => 'text-blue-500'],
                ['name' => 'JavaScript', 'count' => 15, 'icon' => 'fab fa-js', 'color' => 'text-yellow-500'],
                ['name' => 'PHP', 'count' => 10, 'icon' => 'fab fa-php', 'color' => 'text-purple-500'],
                ['name' => 'CSS', 'count' => 6, 'icon' => 'fab fa-css3', 'color' => 'text-blue-600'],
                ['name' => 'Vue.js', 'count' => 5, 'icon' => 'fab fa-vuejs', 'color' => 'text-green-500'],
                ['name' => 'Node.js', 'count' => 7, 'icon' => 'fab fa-node-js', 'color' => 'text-green-600'],
                ['name' => 'Dicas', 'count' => 20, 'icon' => 'fas fa-lightbulb', 'color' => 'text-yellow-600']
            ];
            @endphp
            
            @foreach($categories as $category)
            <a href="{{ route('blog.index', ['tag' => $category['name']]) }}" 
               class="card p-6 text-center hover:shadow-lg transition-all duration-300 group">
                <i class="{{ $category['icon'] }} text-3xl {{ $category['color'] }} mb-3 group-hover:scale-110 transition-transform duration-200"></i>
                <h3 class="font-semibold mb-1">{{ $category['name'] }}</h3>
                <p class="text-sm text-gray-500">{{ $category['count'] }} artigos</p>
            </a>
            @endforeach
        </div>
    </div>
</section>
@endsection

@push('styles')
<style>
    .filter-btn {
        @apply px-4 py-2 rounded-full text-sm font-medium transition-all duration-200 border border-gray-300 text-gray-600 hover:border-blue-500 hover:text-blue-600;
    }
    
    .filter-btn.active {
        @apply bg-blue-600 text-white border-blue-600;
    }
    
    .line-clamp-3 {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
@endpush


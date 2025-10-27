@extends('layouts.app')

@section('title', 'Portfolio - Meus Projetos')
@section('description', 'Conheça meus projetos de desenvolvimento web: sites, aplicações, e-commerce e sistemas desenvolvidos com as melhores tecnologias.')

@section('content')
<!-- Hero Section -->
<section class="bg-gradient-primary text-white section-padding">
    <div class="container-custom text-center">
        <h1 class="heading-xl text-white mb-6">Meu Portfolio</h1>
        <p class="text-lead text-blue-100 max-w-3xl mx-auto">
            Conheça alguns dos projetos que desenvolvi, desde sites institucionais até aplicações complexas.
        </p>
    </div>
</section>

<!-- Filters -->
<section class="py-8 bg-white border-b border-gray-100">
    <div class="container-custom">
        <div class="flex flex-col lg:flex-row gap-6 items-center justify-between">
            <!-- Technology Filter -->
            <div class="flex flex-wrap gap-2">
                <a href="{{ route('portfolio.index') }}" 
                   class="filter-btn {{ !request('technology') ? 'active' : '' }}">
                    Todos
                </a>
                @foreach($allTechnologies as $tech)
                <a href="{{ route('portfolio.index', ['technology' => $tech]) }}" 
                   class="filter-btn {{ request('technology') == $tech ? 'active' : '' }}">
                    {{ $tech }}
                </a>
                @endforeach
            </div>
            
            <!-- Search -->
            <div class="relative">
                <form method="GET" action="{{ route('portfolio.index') }}" class="flex">
                    <input type="hidden" name="technology" value="{{ request('technology') }}">
                    <input type="text" 
                           name="search" 
                           value="{{ request('search') }}"
                           placeholder="Buscar projetos..." 
                           class="form-input pr-10 w-64">
                    <button type="submit" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- Projects Grid -->
<section class="section-padding bg-gray-50">
    <div class="container-custom">
        @if($projects->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($projects as $project)
                <div class="project-card group">
                    <!-- Project Image -->
                    <div class="relative overflow-hidden">
                        @if($project->image)
                            <img src="{{ $project->image_url }}" 
                                 alt="{{ $project->title }}" 
                                 class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300">
                        @else
                            <div class="w-full h-48 bg-gradient-secondary flex items-center justify-center">
                                <i class="fas fa-image text-4xl text-gray-400"></i>
                            </div>
                        @endif
                        
                        <!-- Overlay -->
                        <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-50 transition-all duration-300 flex items-center justify-center">
                            <div class="opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                <a href="{{ route('portfolio.show', $project) }}" 
                                   class="btn-secondary mr-2">
                                    <i class="fas fa-eye"></i>
                                </a>
                                @if($project->project_url)
                                <a href="{{ $project->project_url }}" 
                                   target="_blank" 
                                   class="btn-secondary">
                                    <i class="fas fa-external-link-alt"></i>
                                </a>
                                @endif
                            </div>
                        </div>
                        
                        <!-- Status Badge -->
                        <div class="absolute top-4 left-4">
                            <span class="status-{{ $project->status }}">
                                @switch($project->status)
                                    @case('completed')
                                        Concluído
                                        @break
                                    @case('in_progress')
                                        Em Andamento
                                        @break
                                    @case('planned')
                                        Planejado
                                        @break
                                @endswitch
                            </span>
                        </div>
                        
                        @if($project->featured)
                        <div class="absolute top-4 right-4">
                            <span class="bg-yellow-500 text-white px-2 py-1 rounded-full text-xs font-medium">
                                <i class="fas fa-star mr-1"></i>Destaque
                            </span>
                        </div>
                        @endif
                    </div>
                    
                    <!-- Project Info -->
                    <div class="p-6">
                        <h3 class="font-bold text-xl mb-2 group-hover:text-blue-600 transition-colors duration-200">
                            <a href="{{ route('portfolio.show', $project) }}">{{ $project->title }}</a>
                        </h3>
                        
                        <p class="text-gray-600 text-sm mb-4 line-clamp-2">
                            {{ $project->short_description }}
                        </p>
                        
                        <!-- Technologies -->
                        <div class="flex flex-wrap gap-1 mb-4">
                            @foreach(array_slice($project->technologies, 0, 4) as $tech)
                                <span class="tag">{{ $tech }}</span>
                            @endforeach
                            @if(count($project->technologies) > 4)
                                <span class="tag">+{{ count($project->technologies) - 4 }}</span>
                            @endif
                        </div>
                        
                        <!-- Project Meta -->
                        <div class="flex justify-between items-center text-sm text-gray-500 mb-4">
                            @if($project->completion_date)
                            <span>
                                <i class="fas fa-calendar mr-1"></i>
                                {{ $project->completion_date->format('M Y') }}
                            </span>
                            @endif
                            
                            <div class="flex space-x-3">
                                @if($project->github_url)
                                <a href="{{ $project->github_url }}" 
                                   target="_blank" 
                                   class="text-gray-400 hover:text-gray-600 transition-colors">
                                    <i class="fab fa-github"></i>
                                </a>
                                @endif
                                @if($project->project_url)
                                <a href="{{ $project->project_url }}" 
                                   target="_blank" 
                                   class="text-gray-400 hover:text-gray-600 transition-colors">
                                    <i class="fas fa-external-link-alt"></i>
                                </a>
                                @endif
                            </div>
                        </div>
                        
                        <!-- View Details Button -->
                        <a href="{{ route('portfolio.show', $project) }}" 
                           class="btn-outline w-full text-center">
                            Ver Detalhes
                            <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
            
            <!-- Pagination -->
            @if($projects->hasPages())
            <div class="mt-12">
                {{ $projects->appends(request()->query())->links() }}
            </div>
            @endif
        @else
            <!-- Empty State -->
            <div class="text-center py-16">
                <div class="w-24 h-24 bg-gray-200 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-search text-3xl text-gray-400"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Nenhum projeto encontrado</h3>
                <p class="text-gray-600 mb-6">
                    @if(request('technology') || request('search'))
                        Tente ajustar os filtros ou fazer uma nova busca.
                    @else
                        Em breve novos projetos serão adicionados ao portfolio.
                    @endif
                </p>
                @if(request('technology') || request('search'))
                <a href="{{ route('portfolio.index') }}" class="btn-primary">
                    Ver Todos os Projetos
                </a>
                @endif
            </div>
        @endif
    </div>
</section>

<!-- Stats Section -->
<section class="section-padding bg-white">
    <div class="container-custom">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
            @php
            $stats = [
                [
                    'number' => $projects->total(),
                    'label' => 'Projetos Realizados',
                    'icon' => 'fas fa-laptop-code'
                ],
                [
                    'number' => $allTechnologies->count(),
                    'label' => 'Tecnologias Utilizadas',
                    'icon' => 'fas fa-tools'
                ],
                [
                    'number' => '5+',
                    'label' => 'Anos de Experiência',
                    'icon' => 'fas fa-calendar-alt'
                ],
                [
                    'number' => '100%',
                    'label' => 'Projetos Entregues',
                    'icon' => 'fas fa-check-circle'
                ]
            ];
            @endphp
            
            @foreach($stats as $stat)
            <div>
                <div class="w-16 h-16 bg-gradient-primary rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="{{ $stat['icon'] }} text-2xl text-white"></i>
                </div>
                <div class="text-3xl font-bold text-gray-900 mb-2">{{ $stat['number'] }}</div>
                <div class="text-gray-600">{{ $stat['label'] }}</div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="section-padding bg-gradient-primary text-white">
    <div class="container-custom text-center">
        <h2 class="heading-lg text-white mb-6">Gostou do que viu?</h2>
        <p class="text-lead text-blue-100 mb-8 max-w-2xl mx-auto">
            Vamos conversar sobre como posso ajudar com seu próximo projeto.
        </p>
        
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('contact.index') }}" class="btn-secondary">
                <i class="fas fa-envelope mr-2"></i>
                Solicitar Orçamento
            </a>
            <a href="{{ route('services') }}" class="btn-outline border-white text-white hover:bg-white hover:text-blue-600">
                <i class="fas fa-list mr-2"></i>
                Ver Serviços
            </a>
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
    
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
@endpush


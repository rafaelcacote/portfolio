@extends("layouts.app")

@section("title", $project->title . " - Portfolio")
@section("description", $project->short_description)

@section("content")
<!-- Project Header -->
<section class="bg-gradient-primary text-white section-padding">
    <div class="container-custom">
        <div class="text-center">
            <h1 class="heading-xl text-white mb-6">{{ $project->title }}</h1>
            <p class="text-lead text-blue-100 max-w-3xl mx-auto">
                {{ $project->short_description }}
            </p>
        </div>
    </div>
</section>

<!-- Main Content -->
<section class="section-padding bg-white">
    <div class="container-custom">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
            <!-- Project Details -->
            <div class="lg:col-span-2">
                <!-- Project Image -->
                <div class="mb-8">
                    @if($project->image)
                        <img src="{{ $project->image_url }}" 
                             alt="{{ $project->title }}" 
                             class="w-full rounded-lg shadow-lg">
                    @else
                        <div class="w-full aspect-video bg-gradient-secondary rounded-lg flex items-center justify-center">
                            <i class="fas fa-image text-6xl text-gray-400"></i>
                        </div>
                    @endif
                </div>
                
                <!-- Project Description -->
                <div class="prose max-w-none">
                    {!! nl2br(e($project->description)) !!}
                </div>
                
                <!-- Image Gallery -->
                @if($project->gallery && count($project->gallery) > 0)
                <div class="mt-12">
                    <h2 class="heading-md mb-6">Galeria de Imagens</h2>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                        @foreach($project->gallery as $image)
                        <a href="{{ asset("storage/" . $image) }}" data-fancybox="gallery">
                            <img src="{{ asset("storage/" . $image) }}" 
                                 alt="Imagem da galeria" 
                                 class="w-full h-40 object-cover rounded-lg shadow-md hover:shadow-xl transition-all duration-300">
                        </a>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
            
            <!-- Sidebar -->
            <aside>
                <div class="sticky top-24">
                    <div class="card p-6">
                        <h3 class="font-bold text-lg mb-4">Detalhes do Projeto</h3>
                        
                        <ul class="space-y-3 text-sm">
                            <li class="flex items-center">
                                <i class="fas fa-calendar w-5 h-5 mr-3 text-gray-400"></i>
                                <span>
                                    <strong>Data:</strong> 
                                    {{ $project->completion_date ? $project->completion_date->format("d/m/Y") : "N/A" }}
                                </span>
                            </li>
                            <li class="flex items-center">
                                <i class="fas fa-tag w-5 h-5 mr-3 text-gray-400"></i>
                                <span>
                                    <strong>Status:</strong> 
                                    <span class="status-{{ $project->status }}">{{ ucfirst($project->status) }}</span>
                                </span>
                            </li>
                        </ul>
                        
                        <div class="mt-6 pt-6 border-t border-gray-100">
                            <h4 class="font-semibold mb-3">Tecnologias Utilizadas</h4>
                            <div class="flex flex-wrap gap-2">
                                @foreach($project->technologies as $tech)
                                    <span class="tag">{{ $tech }}</span>
                                @endforeach
                            </div>
                        </div>
                        
                        <div class="mt-6 pt-6 border-t border-gray-100">
                            <h4 class="font-semibold mb-3">Links do Projeto</h4>
                            <div class="space-y-3">
                                @if($project->project_url)
                                <a href="{{ $project->project_url }}" 
                                   target="_blank" 
                                   class="flex items-center text-blue-600 hover:text-blue-800">
                                    <i class="fas fa-external-link-alt w-5 h-5 mr-3"></i>
                                    <span>Ver Projeto Online</span>
                                </a>
                                @endif
                                @if($project->github_url)
                                <a href="{{ $project->github_url }}" 
                                   target="_blank" 
                                   class="flex items-center text-blue-600 hover:text-blue-800">
                                    <i class="fab fa-github w-5 h-5 mr-3"></i>
                                    <span>Ver no GitHub</span>
                                </a>
                                @endif
                                @if($project->demo_url)
                                <a href="{{ $project->demo_url }}" 
                                   target="_blank" 
                                   class="flex items-center text-blue-600 hover:text-blue-800">
                                    <i class="fas fa-play-circle w-5 h-5 mr-3"></i>
                                    <span>Ver Demonstração</span>
                                </a>
                                @endif
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-8">
                        <a href="{{ route("contact.index") }}" class="btn-primary w-full text-center">
                            Iniciar um Projeto Similar
                        </a>
                    </div>
                </div>
            </aside>
        </div>
    </div>
</section>

<!-- Related Projects -->
@if($relatedProjects->count() > 0)
<section class="section-padding bg-gray-50">
    <div class="container-custom">
        <h2 class="heading-lg text-center mb-12">Projetos Relacionados</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($relatedProjects as $relatedProject)
            <div class="project-card">
                <div class="aspect-w-16 aspect-h-9 bg-gray-200">
                    @if($relatedProject->image)
                        <img src="{{ $relatedProject->image_url }}" 
                             alt="{{ $relatedProject->title }}" 
                             class="w-full h-48 object-cover">
                    @else
                        <div class="w-full h-48 bg-gradient-secondary flex items-center justify-center">
                            <i class="fas fa-image text-4xl text-gray-400"></i>
                        </div>
                    @endif
                </div>
                
                <div class="p-6">
                    <h3 class="font-bold text-lg mb-2">{{ $relatedProject->title }}</h3>
                    <p class="text-gray-600 text-sm mb-4 line-clamp-2">{{ $relatedProject->short_description }}</p>
                    
                    <div class="flex flex-wrap gap-1 mb-4">
                        @foreach(array_slice($relatedProject->technologies, 0, 3) as $tech)
                            <span class="tag">{{ $tech }}</span>
                        @endforeach
                    </div>
                    
                    <a href="{{ route("portfolio.show", $relatedProject) }}" 
                       class="text-blue-600 hover:text-blue-800 font-medium text-sm">
                        Ver Detalhes <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Back to Portfolio -->
<div class="py-12 bg-white text-center">
    <a href="{{ route("portfolio.index") }}" class="btn-secondary">
        <i class="fas fa-arrow-left mr-2"></i>
        Voltar ao Portfolio
    </a>
</div>
@endsection

@push("styles")
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4/dist/fancybox.css" />
<style>
    .prose {
        color: #374151;
    }
    .prose h2 {
        @apply text-2xl font-bold mb-4;
    }
    .prose p {
        @apply mb-4;
    }
    .prose ul {
        @apply list-disc list-inside mb-4;
    }
    .prose li {
        @apply mb-2;
    }
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
@endpush

@push("scripts")
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4/dist/fancybox.umd.js"></script>
<script>
    Fancybox.bind("[data-fancybox]", {
        // Your custom options
    });
</script>
@endpush


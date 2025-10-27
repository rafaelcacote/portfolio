@extends('layouts.app')

@section('title', 'Portfolio Profissional - Desenvolvedor Web')
@section('description', 'Portfolio profissional de desenvolvimento web. Criação de sites, sistemas e aplicações modernas com as melhores tecnologias.')

@section('content')
<!-- Hero Section -->
<section class="relative bg-gradient-primary text-white overflow-hidden">
    <div class="absolute inset-0 bg-black opacity-10"></div>
    <div class="relative container-custom section-padding">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div class="fade-in">
                <h1 class="heading-xl text-white mb-6">
                    Olá, eu sou <span class="text-yellow-300">Rafael Caçote</span>
                </h1>
                <p class="text-lead text-blue-100 mb-8">
                    Desenvolvedor Full Stack especializado em criar experiências digitais excepcionais. 
                    Transformo ideias em soluções web modernas, funcionais e visualmente impressionantes.
                </p>
                
                <div class="flex flex-col sm:flex-row gap-4 mb-8">
                    <a href="{{ route('portfolio.index') }}" class="btn-secondary">
                        <i class="fas fa-eye mr-2"></i>
                        Ver Portfolio
                    </a>
                    <a href="{{ route('contact.index') }}" class="btn-outline border-white text-white hover:bg-white hover:text-blue-600">
                        <i class="fas fa-envelope mr-2"></i>
                        Entre em Contato
                    </a>
                </div>
                
                <!-- Stats -->
                <div class="grid grid-cols-3 gap-6 pt-8 border-t border-blue-400">
                    <div class="text-center">
                        <div class="text-2xl font-bold text-yellow-300">{{ $stats['projects_completed'] }}+</div>
                        <div class="text-sm text-blue-100">Projetos Concluídos</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-bold text-yellow-300">{{ $stats['years_experience'] }}+</div>
                        <div class="text-sm text-blue-100">Anos de Experiência</div>
                    </div>
                    <!-- <div class="text-center">
                        <div class="text-2xl font-bold text-yellow-300">{{ $stats['blog_posts'] }}+</div>
                        <div class="text-sm text-blue-100">Artigos Publicados</div>
                    </div> -->
                </div>
            </div>
            
            <div class="relative scale-in">
                <div class="relative">
                    <!-- Profile Image Placeholder -->
                    <div class="w-80 h-80 mx-auto bg-white/10 rounded-full flex items-center justify-center backdrop-blur-sm overflow-hidden">
                        <img src="{{ asset('images/eu2.jfif') }}" alt="Rafael Caçote" class="w-full h-full object-cover">
                    </div>
                    
                    <!-- Floating Elements -->
                    <div class="absolute -top-4 -right-4 w-20 h-20 bg-yellow-300 rounded-full flex items-center justify-center animate-bounce">
                        <i class="fas fa-code text-blue-600 text-xl"></i>
                    </div>
                    <div class="absolute -bottom-4 -left-4 w-16 h-16 bg-white/20 rounded-full flex items-center justify-center backdrop-blur-sm">
                        <i class="fas fa-laptop-code text-white text-lg"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Wave Shape -->
    <div class="absolute bottom-0 left-0 w-full">
        <svg viewBox="0 0 1200 120" preserveAspectRatio="none" class="relative block w-full h-16 fill-gray-50">
            <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z"></path>
        </svg>
    </div>
</section>

<!-- About Section -->
<section class="section-padding bg-white">
    <div class="container-custom">
        <div class="text-center mb-16">
            <h2 class="heading-lg mb-4">Sobre Mim</h2>
            <p class="text-lead max-w-3xl mx-auto">
                Sou um desenvolvedor apaixonado por tecnologia e inovação, com foco em criar soluções que fazem a diferença.
            </p>
        </div>
        
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            <div class="slide-up">
                <h3 class="heading-md mb-6">Minha Jornada</h3>
                <p class="text-gray-600 mb-6">
                    Com mais de {{ $stats['years_experience'] }} anos de experiência em desenvolvimento web, 
                    tenho trabalhado com empresas de diversos segmentos, desde startups até grandes corporações.
                </p>
                <p class="text-gray-600 mb-8">
                    Minha especialidade está em criar aplicações web robustas, escaláveis e com excelente 
                    experiência do usuário, utilizando as tecnologias mais modernas do mercado.
                </p>
                
                <!-- Skills -->
                <div class="space-y-4">
                    <div>
                        <div class="flex justify-between mb-2">
                            <span class="font-semibold">Frontend Development</span>
                            <span class="text-gray-500">95%</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-gradient-primary h-2 rounded-full" style="width: 95%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between mb-2">
                            <span class="font-semibold">Backend Development</span>
                            <span class="text-gray-500">90%</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-gradient-primary h-2 rounded-full" style="width: 90%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between mb-2">
                            <span class="font-semibold">UI/UX Design</span>
                            <span class="text-gray-500">85%</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-gradient-primary h-2 rounded-full" style="width: 85%"></div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="slide-up">
                <!-- Technologies -->
                <h3 class="heading-md mb-6">Tecnologias</h3>
                <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                    @php
                    $technologies = [
                        ['name' => 'Laravel', 'icon' => 'fab fa-laravel', 'color' => 'text-red-500'],
                        ['name' => 'Vue.js', 'icon' => 'fab fa-vuejs', 'color' => 'text-green-500'],
                        ['name' => 'Inertia.js', 'icon' => 'fas fa-random', 'color' => 'text-green-500'],
                        ['name' => 'React', 'icon' => 'fab fa-react', 'color' => 'text-blue-500'],
                        ['name' => 'Node.js', 'icon' => 'fab fa-node-js', 'color' => 'text-green-600'],
                        ['name' => 'PHP', 'icon' => 'fab fa-php', 'color' => 'text-purple-500'],
                        ['name' => 'JavaScript', 'icon' => 'fab fa-js', 'color' => 'text-yellow-500'],
                        ['name' => 'MySQL', 'icon' => 'fas fa-database', 'color' => 'text-blue-600'],
                        ['name' => 'Git', 'icon' => 'fab fa-git-alt', 'color' => 'text-orange-500'],
                        
                    ];
                    @endphp
                    
                    @foreach($technologies as $tech)
                    <div class="card p-4 text-center hover:shadow-lg transition-all duration-300">
                        <i class="{{ $tech['icon'] }} text-3xl {{ $tech['color'] }} mb-2"></i>
                        <div class="font-medium text-sm">{{ $tech['name'] }}</div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Services Section -->
<section class="section-padding bg-gray-50">
    <div class="container-custom">
        <div class="text-center mb-16">
            <h2 class="heading-lg mb-4">Meus Serviços</h2>
            <p class="text-lead max-w-3xl mx-auto">
                Ofereço soluções completas em desenvolvimento web, desde a concepção até a implementação final.
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @php
            $services = [
                [
                    'icon' => 'fas fa-laptop-code',
                    'title' => 'Desenvolvimento Web',
                    'description' => 'Criação de sites e aplicações web responsivas, modernas e otimizadas para performance.',
                    'features' => ['Sites Responsivos', 'Aplicações Web', 'E-commerce', 'Landing Pages']
                ],
                [
                    'icon' => 'fas fa-mobile-alt',
                    'title' => 'Aplicações Mobile',
                    'description' => 'Desenvolvimento de aplicativos mobile híbridos com React Native e Progressive Web Apps.',
                    'features' => ['React Native', 'PWA', 'App Híbrido', 'UI/UX Mobile']
                ],
                [
                    'icon' => 'fas fa-server',
                    'title' => 'Backend & APIs',
                    'description' => 'Desenvolvimento de APIs RESTful, sistemas backend robustos e integração de serviços.',
                    'features' => ['APIs REST', 'Microserviços', 'Banco de Dados', 'Integração']
                ],
                [
                    'icon' => 'fas fa-paint-brush',
                    'title' => 'UI/UX Design',
                    'description' => 'Design de interfaces intuitivas e experiências de usuário excepcionais.',
                    'features' => ['Prototipagem', 'Design System', 'Wireframes', 'User Research']
                ],
                [
                    'icon' => 'fas fa-search',
                    'title' => 'SEO & Performance',
                    'description' => 'Otimização para motores de busca e melhoria de performance das aplicações.',
                    'features' => ['SEO Técnico', 'Performance', 'Analytics', 'Core Web Vitals']
                ],
                [
                    'icon' => 'fas fa-tools',
                    'title' => 'Manutenção & Suporte',
                    'description' => 'Suporte técnico contínuo, manutenção e atualizações de sistemas existentes.',
                    'features' => ['Suporte 24/7', 'Atualizações', 'Backup', 'Monitoramento']
                ]
            ];
            @endphp
            
            @foreach($services as $service)
            <div class="card p-8 text-center card-hover">
                <div class="w-16 h-16 bg-gradient-primary rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="{{ $service['icon'] }} text-2xl text-white"></i>
                </div>
                <h3 class="heading-sm mb-4">{{ $service['title'] }}</h3>
                <p class="text-gray-600 mb-6">{{ $service['description'] }}</p>
                <ul class="space-y-2">
                    @foreach($service['features'] as $feature)
                    <li class="text-sm text-gray-500">
                        <i class="fas fa-check text-green-500 mr-2"></i>
                        {{ $feature }}
                    </li>
                    @endforeach
                </ul>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Featured Projects Section -->
@if($featuredProjects->count() > 0)
<section class="section-padding bg-white">
    <div class="container-custom">
        <div class="text-center mb-16">
            <h2 class="heading-lg mb-4">Projetos em Destaque</h2>
            <p class="text-lead max-w-3xl mx-auto">
                Alguns dos meus trabalhos mais recentes e impactantes.
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($featuredProjects as $project)
            <div class="project-card">
                <div class="aspect-w-16 aspect-h-9 bg-gray-200">
                    @if($project->image)
                        <img src="{{ $project->image_url }}" alt="{{ $project->title }}" class="w-full h-48 object-cover">
                    @else
                        <div class="w-full h-48 bg-gradient-secondary flex items-center justify-center">
                            <i class="fas fa-image text-4xl text-gray-400"></i>
                        </div>
                    @endif
                </div>
                
                <div class="p-6">
                    <div class="flex items-center justify-between mb-3">
                        <span class="status-{{ $project->status }}">
                            {{ ucfirst($project->status) }}
                        </span>
                        @if($project->featured)
                            <span class="text-yellow-500">
                                <i class="fas fa-star"></i>
                            </span>
                        @endif
                    </div>
                    
                    <h3 class="font-bold text-lg mb-2">{{ $project->title }}</h3>
                    <p class="text-gray-600 text-sm mb-4">{{ $project->short_description }}</p>
                    
                    <!-- Technologies -->
                    <div class="flex flex-wrap gap-1 mb-4">
                        @foreach(array_slice($project->technologies, 0, 3) as $tech)
                            <span class="tag">{{ $tech }}</span>
                        @endforeach
                        @if(count($project->technologies) > 3)
                            <span class="tag">+{{ count($project->technologies) - 3 }}</span>
                        @endif
                    </div>
                    
                    <div class="flex justify-between items-center">
                        <a href="{{ route('portfolio.show', $project) }}" class="text-blue-600 hover:text-blue-800 font-medium text-sm">
                            Ver Detalhes <i class="fas fa-arrow-right ml-1"></i>
                        </a>
                        
                        <div class="flex space-x-2">
                            @if($project->project_url)
                                <a href="{{ $project->project_url }}" target="_blank" class="text-gray-400 hover:text-gray-600">
                                    <i class="fas fa-external-link-alt"></i>
                                </a>
                            @endif
                            @if($project->github_url)
                                <a href="{{ $project->github_url }}" target="_blank" class="text-gray-400 hover:text-gray-600">
                                    <i class="fab fa-github"></i>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        
        <div class="text-center mt-12">
            <a href="{{ route('portfolio.index') }}" class="btn-primary">
                Ver Todos os Projetos
                <i class="fas fa-arrow-right ml-2"></i>
            </a>
        </div>
    </div>
</section>
@endif

<!-- Recent Blog Posts -->
@if($recentPosts->count() > 0)
<section class="section-padding bg-gray-50">
    <div class="container-custom">
        <div class="text-center mb-16">
            <h2 class="heading-lg mb-4">Últimos Artigos</h2>
            <p class="text-lead max-w-3xl mx-auto">
                Compartilho conhecimentos e experiências sobre desenvolvimento web e tecnologia.
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($recentPosts as $post)
            <article class="blog-card">
                <div class="aspect-w-16 aspect-h-9 bg-gray-200">
                    @if($post->featured_image)
                        <img src="{{ $post->featured_image_url }}" alt="{{ $post->title }}" class="w-full h-48 object-cover">
                    @else
                        <div class="w-full h-48 bg-gradient-secondary flex items-center justify-center">
                            <i class="fas fa-newspaper text-4xl text-gray-400"></i>
                        </div>
                    @endif
                </div>
                
                <div class="p-6">
                    <div class="flex items-center text-sm text-gray-500 mb-3">
                        <time datetime="{{ $post->published_at->format('Y-m-d') }}">
                            {{ $post->published_at->format('d/m/Y') }}
                        </time>
                        <span class="mx-2">•</span>
                        <span>{{ $post->reading_time }} min de leitura</span>
                    </div>
                    
                    <h3 class="font-bold text-lg mb-2 line-clamp-2">{{ $post->title }}</h3>
                    <p class="text-gray-600 text-sm mb-4 line-clamp-3">{{ $post->excerpt }}</p>
                    
                    @if($post->tags)
                    <div class="flex flex-wrap gap-1 mb-4">
                        @foreach(array_slice($post->tags, 0, 2) as $tag)
                            <span class="tag">{{ $tag }}</span>
                        @endforeach
                    </div>
                    @endif
                    
                    <a href="{{ route('blog.show', $post) }}" class="text-blue-600 hover:text-blue-800 font-medium text-sm">
                        Ler Artigo <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                </div>
            </article>
            @endforeach
        </div>
        
        <div class="text-center mt-12">
            <a href="{{ route('blog.index') }}" class="btn-secondary">
                Ver Todos os Artigos
                <i class="fas fa-arrow-right ml-2"></i>
            </a>
        </div>
    </div>
</section>
@endif

<!-- CTA Section -->
<section class="section-padding bg-gradient-primary text-white">
    <div class="container-custom text-center">
        <h2 class="heading-lg text-white mb-6">Pronto para Começar seu Projeto?</h2>
        <p class="text-lead text-blue-100 mb-8 max-w-2xl mx-auto">
            Vamos conversar sobre como posso ajudar a transformar suas ideias em realidade digital.
        </p>
        
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('contact.index') }}" class="btn-secondary">
                <i class="fas fa-envelope mr-2"></i>
                Solicitar Orçamento
            </a>
            <a href="https://wa.me/5511999999999" target="_blank" class="btn-outline border-white text-white hover:bg-white hover:text-blue-600">
                <i class="fab fa-whatsapp mr-2"></i>
                WhatsApp
            </a>
        </div>
    </div>
</section>
@endsection

@push('styles')
<style>
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    
    .line-clamp-3 {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
@endpush


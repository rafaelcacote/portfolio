@extends('layouts.app')

@section('title', $blogPost->title . ' - Blog')
@section('description', $blogPost->excerpt)

@section('content')
<!-- Article Header -->
<article class="bg-white">
    <header class="section-padding bg-gray-50 border-b border-gray-100">
        <div class="container-custom">
            <div class="max-w-4xl mx-auto text-center">
                <!-- Breadcrumb -->
                <nav class="mb-8">
                    <ol class="flex items-center justify-center space-x-2 text-sm text-gray-500">
                        <li><a href="{{ route('home') }}" class="hover:text-blue-600">Início</a></li>
                        <li><i class="fas fa-chevron-right text-xs"></i></li>
                        <li><a href="{{ route('blog.index') }}" class="hover:text-blue-600">Blog</a></li>
                        <li><i class="fas fa-chevron-right text-xs"></i></li>
                        <li class="text-gray-900">{{ Str::limit($blogPost->title, 30) }}</li>
                    </ol>
                </nav>
                
                <!-- Article Meta -->
                <div class="flex items-center justify-center space-x-4 text-sm text-gray-500 mb-6">
                    <time datetime="{{ $blogPost->published_at->format('Y-m-d') }}">
                        <i class="fas fa-calendar mr-1"></i>
                        {{ $blogPost->published_at->format('d/m/Y') }}
                    </time>
                    <span>
                        <i class="fas fa-clock mr-1"></i>
                        {{ $blogPost->reading_time }} min de leitura
                    </span>
                    <span>
                        <i class="fas fa-eye mr-1"></i>
                        {{ $blogPost->views }} visualizações
                    </span>
                </div>
                
                <!-- Title -->
                <h1 class="heading-xl mb-6">{{ $blogPost->title }}</h1>
                
                <!-- Excerpt -->
                <p class="text-lead text-gray-600 mb-8">{{ $blogPost->excerpt }}</p>
                
                <!-- Tags -->
                @if($blogPost->tags)
                <div class="flex flex-wrap justify-center gap-2 mb-8">
                    @foreach($blogPost->tags as $tag)
                        <a href="{{ route('blog.index', ['tag' => $tag]) }}" class="tag-outline">
                            {{ $tag }}
                        </a>
                    @endforeach
                </div>
                @endif
                
                <!-- Featured Image -->
                @if($blogPost->featured_image)
                <div class="mb-8">
                    <img src="{{ $blogPost->featured_image_url }}" 
                         alt="{{ $blogPost->title }}" 
                         class="w-full max-w-4xl mx-auto rounded-lg shadow-lg">
                </div>
                @endif
            </div>
        </div>
    </header>
    
    <!-- Article Content -->
    <div class="section-padding">
        <div class="container-custom">
            <div class="max-w-4xl mx-auto">
                <div class="prose prose-lg max-w-none">
                    {!! nl2br(e($blogPost->content)) !!}
                </div>
                
                <!-- Article Footer -->
                <footer class="mt-12 pt-8 border-t border-gray-200">
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                        <!-- Tags -->
                        @if($blogPost->tags)
                        <div>
                            <h3 class="font-semibold text-sm text-gray-700 mb-2">Tags:</h3>
                            <div class="flex flex-wrap gap-2">
                                @foreach($blogPost->tags as $tag)
                                    <a href="{{ route('blog.index', ['tag' => $tag]) }}" class="tag">
                                        {{ $tag }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                        @endif
                        
                        <!-- Share Buttons -->
                        <div>
                            <h3 class="font-semibold text-sm text-gray-700 mb-2">Compartilhar:</h3>
                            <div class="flex space-x-2">
                                <a href="https://twitter.com/intent/tweet?text={{ urlencode($blogPost->title) }}&url={{ urlencode(request()->fullUrl()) }}" 
                                   target="_blank" 
                                   class="w-10 h-10 bg-blue-500 hover:bg-blue-600 text-white rounded-full flex items-center justify-center transition-colors">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}" 
                                   target="_blank" 
                                   class="w-10 h-10 bg-blue-600 hover:bg-blue-700 text-white rounded-full flex items-center justify-center transition-colors">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(request()->fullUrl()) }}" 
                                   target="_blank" 
                                   class="w-10 h-10 bg-blue-700 hover:bg-blue-800 text-white rounded-full flex items-center justify-center transition-colors">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                                <a href="https://wa.me/?text={{ urlencode($blogPost->title . ' - ' . request()->fullUrl()) }}" 
                                   target="_blank" 
                                   class="w-10 h-10 bg-green-500 hover:bg-green-600 text-white rounded-full flex items-center justify-center transition-colors">
                                    <i class="fab fa-whatsapp"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
    </div>
</article>

<!-- Author Section -->
<section class="section-padding bg-gray-50">
    <div class="container-custom">
        <div class="max-w-4xl mx-auto">
            <div class="card p-8">
                <div class="flex flex-col md:flex-row items-center md:items-start gap-6">
                    <!-- Author Avatar -->
                    <div class="flex-shrink-0">
                        <div class="w-24 h-24 bg-gradient-primary rounded-full flex items-center justify-center">
                            <i class="fas fa-user text-3xl text-white"></i>
                        </div>
                    </div>
                    
                    <!-- Author Info -->
                    <div class="flex-1 text-center md:text-left">
                        <h3 class="font-bold text-xl mb-2">João Silva</h3>
                        <p class="text-gray-600 mb-4">
                            Desenvolvedor Full Stack apaixonado por tecnologia e inovação. 
                            Especialista em Laravel, React e desenvolvimento de soluções web modernas.
                        </p>
                        
                        <!-- Author Social Links -->
                        <div class="flex justify-center md:justify-start space-x-3">
                            <a href="https://linkedin.com/in/joaosilva" target="_blank" class="social-link">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                            <a href="https://github.com/joaosilva" target="_blank" class="social-link">
                                <i class="fab fa-github"></i>
                            </a>
                            <a href="https://twitter.com/joaosilva" target="_blank" class="social-link">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="mailto:joao.silva@email.com" class="social-link">
                                <i class="fas fa-envelope"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Related Posts -->
@if($relatedPosts->count() > 0)
<section class="section-padding bg-white">
    <div class="container-custom">
        <div class="max-w-4xl mx-auto">
            <h2 class="heading-lg text-center mb-12">Artigos Relacionados</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($relatedPosts as $relatedPost)
                <article class="blog-card">
                    <div class="aspect-w-16 aspect-h-9 bg-gray-200">
                        @if($relatedPost->featured_image)
                            <img src="{{ $relatedPost->featured_image_url }}" 
                                 alt="{{ $relatedPost->title }}" 
                                 class="w-full h-48 object-cover">
                        @else
                            <div class="w-full h-48 bg-gradient-secondary flex items-center justify-center">
                                <i class="fas fa-newspaper text-4xl text-gray-400"></i>
                            </div>
                        @endif
                    </div>
                    
                    <div class="p-6">
                        <div class="flex items-center text-sm text-gray-500 mb-3">
                            <time datetime="{{ $relatedPost->published_at->format('Y-m-d') }}">
                                {{ $relatedPost->published_at->format('d/m/Y') }}
                            </time>
                            <span class="mx-2">•</span>
                            <span>{{ $relatedPost->reading_time }} min</span>
                        </div>
                        
                        <h3 class="font-bold text-lg mb-2 line-clamp-2">
                            <a href="{{ route('blog.show', $relatedPost) }}" class="hover:text-blue-600 transition-colors">
                                {{ $relatedPost->title }}
                            </a>
                        </h3>
                        
                        <p class="text-gray-600 text-sm mb-4 line-clamp-2">{{ $relatedPost->excerpt }}</p>
                        
                        @if($relatedPost->tags)
                        <div class="flex flex-wrap gap-1 mb-4">
                            @foreach(array_slice($relatedPost->tags, 0, 2) as $tag)
                                <span class="tag">{{ $tag }}</span>
                            @endforeach
                        </div>
                        @endif
                        
                        <a href="{{ route('blog.show', $relatedPost) }}" 
                           class="text-blue-600 hover:text-blue-800 font-medium text-sm">
                            Ler Artigo <i class="fas fa-arrow-right ml-1"></i>
                        </a>
                    </div>
                </article>
                @endforeach
            </div>
        </div>
    </div>
</section>
@endif

<!-- Newsletter CTA -->
<section class="section-padding bg-gradient-primary text-white">
    <div class="container-custom">
        <div class="max-w-2xl mx-auto text-center">
            <h2 class="heading-lg text-white mb-4">Gostou do Artigo?</h2>
            <p class="text-lead text-blue-100 mb-8">
                Receba novos artigos e dicas exclusivas diretamente no seu e-mail.
            </p>
            
            <form class="flex flex-col sm:flex-row gap-4 max-w-md mx-auto mb-6">
                <input type="email" 
                       placeholder="Seu melhor e-mail" 
                       class="form-input flex-1">
                <button type="submit" class="btn-secondary">
                    <i class="fas fa-bell mr-2"></i>
                    Inscrever-se
                </button>
            </form>
            
            <p class="text-sm text-blue-200">
                Sem spam. Cancele a qualquer momento.
            </p>
        </div>
    </div>
</section>

<!-- Navigation -->
<div class="py-8 bg-white border-t border-gray-100">
    <div class="container-custom">
        <div class="max-w-4xl mx-auto flex justify-between items-center">
            <a href="{{ route('blog.index') }}" class="btn-secondary">
                <i class="fas fa-arrow-left mr-2"></i>
                Voltar ao Blog
            </a>
            
            <div class="flex space-x-4">
                <a href="{{ route('contact.index') }}" class="btn-outline">
                    <i class="fas fa-envelope mr-2"></i>
                    Contato
                </a>
                <a href="{{ route('portfolio.index') }}" class="btn-outline">
                    <i class="fas fa-eye mr-2"></i>
                    Portfolio
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .prose {
        color: #374151;
        line-height: 1.75;
    }
    
    .prose h2 {
        @apply text-2xl font-bold mt-8 mb-4 text-gray-900;
    }
    
    .prose h3 {
        @apply text-xl font-bold mt-6 mb-3 text-gray-900;
    }
    
    .prose p {
        @apply mb-4 text-gray-700;
    }
    
    .prose ul, .prose ol {
        @apply mb-4 pl-6;
    }
    
    .prose ul {
        @apply list-disc;
    }
    
    .prose ol {
        @apply list-decimal;
    }
    
    .prose li {
        @apply mb-2;
    }
    
    .prose blockquote {
        @apply border-l-4 border-blue-500 pl-4 italic text-gray-600 my-6;
    }
    
    .prose code {
        @apply bg-gray-100 px-2 py-1 rounded text-sm font-mono;
    }
    
    .prose pre {
        @apply bg-gray-900 text-white p-4 rounded-lg overflow-x-auto my-6;
    }
    
    .prose pre code {
        @apply bg-transparent p-0;
    }
    
    .prose a {
        @apply text-blue-600 hover:text-blue-800 underline;
    }
    
    .prose img {
        @apply rounded-lg shadow-md my-6;
    }
    
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
@endpush

@push('scripts')
<script>
    // Smooth scroll for internal links
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
    
    // Copy to clipboard for code blocks
    document.querySelectorAll('pre code').forEach(block => {
        const button = document.createElement('button');
        button.className = 'absolute top-2 right-2 bg-gray-700 hover:bg-gray-600 text-white px-2 py-1 rounded text-xs';
        button.textContent = 'Copiar';
        
        const wrapper = document.createElement('div');
        wrapper.className = 'relative';
        block.parentNode.parentNode.insertBefore(wrapper, block.parentNode);
        wrapper.appendChild(block.parentNode);
        wrapper.appendChild(button);
        
        button.addEventListener('click', () => {
            navigator.clipboard.writeText(block.textContent).then(() => {
                button.textContent = 'Copiado!';
                setTimeout(() => {
                    button.textContent = 'Copiar';
                }, 2000);
            });
        });
    });
</script>
@endpush


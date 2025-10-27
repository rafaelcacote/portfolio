@extends('admin.layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
<!-- Stats Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Total Projects -->
    <div class="stat-card">
        <div class="flex items-center">
            <div class="stat-card-icon bg-blue-500">
                <i class="fas fa-laptop-code"></i>
            </div>
            <div class="ml-4">
                <div class="stat-card-value">{{ $stats['total_projects'] }}</div>
                <div class="stat-card-label">Total de Projetos</div>
            </div>
        </div>
    </div>
    
    <!-- Active Projects -->
    <div class="stat-card">
        <div class="flex items-center">
            <div class="stat-card-icon bg-green-500">
                <i class="fas fa-play-circle"></i>
            </div>
            <div class="ml-4">
                <div class="stat-card-value">{{ $stats['active_projects'] }}</div>
                <div class="stat-card-label">Projetos Ativos</div>
            </div>
        </div>
    </div>
    
    <!-- Published Posts -->
    <div class="stat-card">
        <div class="flex items-center">
            <div class="stat-card-icon bg-purple-500">
                <i class="fas fa-newspaper"></i>
            </div>
            <div class="ml-4">
                <div class="stat-card-value">{{ $stats['published_posts'] }}</div>
                <div class="stat-card-label">Posts Publicados</div>
            </div>
        </div>
    </div>
    
    <!-- New Messages -->
    <div class="stat-card">
        <div class="flex items-center">
            <div class="stat-card-icon bg-red-500">
                <i class="fas fa-envelope"></i>
            </div>
            <div class="ml-4">
                <div class="stat-card-value">{{ $stats['new_messages'] }}</div>
                <div class="stat-card-label">Mensagens Novas</div>
            </div>
        </div>
    </div>
</div>

<!-- Charts Row -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
    <!-- Monthly Stats Chart -->
    <div class="admin-card">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Estatísticas Mensais</h3>
        <div class="h-64">
            <canvas id="monthlyStatsChart"></canvas>
        </div>
    </div>
    
    <!-- Quick Stats -->
    <div class="admin-card">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Resumo Geral</h3>
        <div class="space-y-4">
            <div class="flex justify-between items-center">
                <span class="text-gray-600">Projetos Concluídos</span>
                <span class="font-semibold">{{ $stats['completed_projects'] }}</span>
            </div>
            <div class="flex justify-between items-center">
                <span class="text-gray-600">Projetos em Destaque</span>
                <span class="font-semibold">{{ $stats['featured_projects'] }}</span>
            </div>
            <div class="flex justify-between items-center">
                <span class="text-gray-600">Posts em Rascunho</span>
                <span class="font-semibold">{{ $stats['draft_posts'] }}</span>
            </div>
            <div class="flex justify-between items-center">
                <span class="text-gray-600">Posts em Destaque</span>
                <span class="font-semibold">{{ $stats['featured_posts'] }}</span>
            </div>
            <div class="flex justify-between items-center">
                <span class="text-gray-600">Mensagens não Lidas</span>
                <span class="font-semibold text-red-600">{{ $stats['unread_messages'] }}</span>
            </div>
        </div>
    </div>
</div>

<!-- Recent Activity -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Recent Projects -->
    <div class="admin-card">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-semibold text-gray-900">Projetos Recentes</h3>
            <a href="{{ route('admin.projects.index') }}" class="text-blue-600 hover:text-blue-800 text-sm">
                Ver todos
            </a>
        </div>
        
        @if($recentProjects->count() > 0)
        <div class="space-y-3">
            @foreach($recentProjects as $project)
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <div class="font-medium text-sm">{{ Str::limit($project->title, 25) }}</div>
                    <div class="text-xs text-gray-500">{{ $project->created_at->diffForHumans() }}</div>
                </div>
                <span class="status-badge {{ $project->status == 'completed' ? 'success' : ($project->status == 'in_progress' ? 'warning' : 'info') }}">
                    {{ ucfirst($project->status) }}
                </span>
            </div>
            @endforeach
        </div>
        @else
        <p class="text-gray-500 text-sm">Nenhum projeto encontrado.</p>
        @endif
    </div>
    
    <!-- Recent Posts -->
    <div class="admin-card">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-semibold text-gray-900">Posts Recentes</h3>
            <a href="{{ route('admin.blog.index') }}" class="text-blue-600 hover:text-blue-800 text-sm">
                Ver todos
            </a>
        </div>
        
        @if($recentPosts->count() > 0)
        <div class="space-y-3">
            @foreach($recentPosts as $post)
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <div class="font-medium text-sm">{{ Str::limit($post->title, 25) }}</div>
                    <div class="text-xs text-gray-500">{{ $post->created_at->diffForHumans() }}</div>
                </div>
                <span class="status-badge {{ $post->status == 'published' ? 'success' : 'warning' }}">
                    {{ ucfirst($post->status) }}
                </span>
            </div>
            @endforeach
        </div>
        @else
        <p class="text-gray-500 text-sm">Nenhum post encontrado.</p>
        @endif
    </div>
    
    <!-- Recent Messages -->
    <div class="admin-card">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-semibold text-gray-900">Mensagens Recentes</h3>
            <a href="{{ route('admin.messages.index') }}" class="text-blue-600 hover:text-blue-800 text-sm">
                Ver todas
            </a>
        </div>
        
        @if($recentMessages->count() > 0)
        <div class="space-y-3">
            @foreach($recentMessages as $message)
            <div class="flex items-start justify-between">
                <div class="flex-1">
                    <div class="font-medium text-sm">{{ $message->name }}</div>
                    <div class="text-xs text-gray-600">{{ Str::limit($message->subject, 30) }}</div>
                    <div class="text-xs text-gray-500">{{ $message->created_at->diffForHumans() }}</div>
                </div>
                @if(!$message->read_at)
                <span class="w-2 h-2 bg-red-500 rounded-full"></span>
                @endif
            </div>
            @endforeach
        </div>
        @else
        <p class="text-gray-500 text-sm">Nenhuma mensagem encontrada.</p>
        @endif
    </div>
</div>

<!-- Quick Actions -->
<div class="mt-8">
    <div class="admin-card">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Ações Rápidas</h3>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <a href="{{ route('admin.projects.create') }}" class="btn-admin-primary">
                <i class="fas fa-plus mr-2"></i>
                Novo Projeto
            </a>
            <a href="{{ route('admin.blog.create') }}" class="btn-admin-primary">
                <i class="fas fa-plus mr-2"></i>
                Novo Post
            </a>
            <a href="{{ route('admin.messages.index') }}" class="btn-admin-secondary">
                <i class="fas fa-envelope mr-2"></i>
                Ver Mensagens
            </a>
            <a href="{{ route('home') }}" target="_blank" class="btn-admin-secondary">
                <i class="fas fa-external-link-alt mr-2"></i>
                Ver Site
            </a>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Monthly Stats Chart
    const ctx = document.getElementById('monthlyStatsChart').getContext('2d');
    const monthlyStatsChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: {!! json_encode(collect($monthlyStats)->pluck('month')) !!},
            datasets: [
                {
                    label: 'Projetos',
                    data: {!! json_encode(collect($monthlyStats)->pluck('projects')) !!},
                    borderColor: 'rgb(59, 130, 246)',
                    backgroundColor: 'rgba(59, 130, 246, 0.1)',
                    tension: 0.4
                },
                {
                    label: 'Posts',
                    data: {!! json_encode(collect($monthlyStats)->pluck('posts')) !!},
                    borderColor: 'rgb(147, 51, 234)',
                    backgroundColor: 'rgba(147, 51, 234, 0.1)',
                    tension: 0.4
                },
                {
                    label: 'Mensagens',
                    data: {!! json_encode(collect($monthlyStats)->pluck('messages')) !!},
                    borderColor: 'rgb(239, 68, 68)',
                    backgroundColor: 'rgba(239, 68, 68, 0.1)',
                    tension: 0.4
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'top',
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                }
            }
        }
    });
</script>
@endpush


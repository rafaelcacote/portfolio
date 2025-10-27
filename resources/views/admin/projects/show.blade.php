@extends('admin.layouts.app')

@section('title', $project->title)

@section('content')
    <div class="container mx-auto py-6">
        <div class="bg-white shadow rounded-lg p-6">
            <h1 class="text-2xl font-bold mb-2">{{ $project->title }}</h1>
            <div class="mb-2 text-gray-600">Status: <span
                    class="badge {{ $project->status === 'completed' ? 'bg-green-500' : ($project->status === 'in_progress' ? 'bg-yellow-500' : 'bg-gray-400') }}">{{ ucfirst($project->status) }}</span>
            </div>
            <div class="mb-2 text-gray-600">Destaque: {{ $project->featured ? 'Sim' : 'Não' }}</div>
            <div class="mb-2 text-gray-600">Ordem: {{ $project->order }}</div>
            <div class="mb-2 text-gray-600">Data de Conclusão:
                {{ $project->completion_date ? \Carbon\Carbon::parse($project->completion_date)->format('d/m/Y') : '-' }}
            </div>
            <div class="mb-2 text-gray-600">Tecnologias:
                {{ $project->technologies ? implode(', ', $project->technologies) : '-' }}</div>
            <div class="mb-2 text-gray-600">URL do Projeto: <a href="{{ $project->project_url }}" target="_blank"
                    class="text-blue-600 underline">{{ $project->project_url }}</a></div>
            <div class="mb-2 text-gray-600">URL do GitHub: <a href="{{ $project->github_url }}" target="_blank"
                    class="text-blue-600 underline">{{ $project->github_url }}</a></div>
            <div class="mb-2 text-gray-600">URL de Demonstração: <a href="{{ $project->demo_url }}" target="_blank"
                    class="text-blue-600 underline">{{ $project->demo_url }}</a></div>
            @if ($project->image)
                <img src="{{ asset('storage/' . $project->image) }}" alt="Imagem de capa" class="h-48 mb-4">
            @endif
            @if ($project->gallery)
                <div class="flex flex-wrap gap-2 mb-4">
                    @foreach ((is_array($project->gallery) ? $project->gallery : json_decode($project->gallery, true)) as $img)
                        <img src="{{ asset('storage/' . $img) }}" alt="Galeria" class="h-16">
                    @endforeach
                </div>
            @endif
            <div class="prose max-w-none mb-4">{!! nl2br(e($project->description)) !!}</div>
            <div class="mt-6 flex gap-2">
                <a href="{{ route('admin.projects.edit', $project) }}" class="btn btn-warning">Editar</a>
                <button type="button" class="btn btn-danger" onclick="openDeleteModal({{ $project->id }}, '{{ addslashes($project->title) }}')">Excluir</button>
                <form id="delete-form-{{ $project->id }}" action="{{ route('admin.projects.destroy', $project) }}" method="POST" class="hidden">
                    @csrf
                    @method('DELETE')
                </form>
                <a href="{{ route('admin.projects.index') }}" class="btn btn-secondary">Voltar</a>
            </div>
        </div>
        
        <!-- Modal de Confirmação -->
        <div id="deleteModal" class="fixed inset-0 z-50 hidden">
            <div class="fixed inset-0 bg-gray-900 bg-opacity-60 backdrop-blur-sm transition-opacity"></div>
            <div class="fixed inset-0 flex items-center justify-center p-4">
                <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full mx-auto transform transition-all">
                    <div class="p-6">
                        <div class="flex items-center justify-center w-12 h-12 mx-auto mb-4 bg-red-100 rounded-full">
                            <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.732-.833-2.5 0L4.268 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 text-center mb-2">Confirmar Exclusão</h3>
                        <p class="text-sm text-gray-600 text-center mb-6">
                            Tem certeza que deseja excluir o projeto "<span id="modalProjectTitle" class="font-medium text-gray-900"></span>"?
                            <br><span class="text-xs text-red-500 mt-1 block">Esta ação não pode ser desfeita.</span>
                        </p>
                        <div class="flex gap-3">
                            <button onclick="closeDeleteModal()" 
                                class="flex-1 px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 border border-gray-300 rounded-lg hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-colors">
                                Cancelar
                            </button>
                            <button id="confirmDeleteBtn" 
                                class="flex-1 px-4 py-2 text-sm font-medium text-white bg-red-600 border border-transparent rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition-colors">
                                Excluir
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            let projectToDelete = null;
            
            function openDeleteModal(id, title) {
                projectToDelete = id;
                document.getElementById('modalProjectTitle').textContent = title;
                const modal = document.getElementById('deleteModal');
                modal.classList.remove('hidden');
                document.body.style.overflow = 'hidden';
            }
            
            function closeDeleteModal() {
                const modal = document.getElementById('deleteModal');
                modal.classList.add('hidden');
                projectToDelete = null;
                document.body.style.overflow = 'auto';
            }
            
            // Fecha modal ao clicar fora
            document.addEventListener('click', function(e) {
                const modal = document.getElementById('deleteModal');
                if (e.target === modal) {
                    closeDeleteModal();
                }
            });
            
            // Fecha modal com ESC
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    closeDeleteModal();
                }
            });
            
            document.addEventListener('DOMContentLoaded', function() {
                document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
                    if (projectToDelete) {
                        document.getElementById('delete-form-' + projectToDelete).submit();
                    }
                });
            });
        </script>
    </div>
@endsection

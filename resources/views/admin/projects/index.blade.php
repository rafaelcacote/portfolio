@extends('admin.layouts.app')

@section('title', 'Projetos')

@section('content')
    <div class="container mx-auto py-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Projetos</h1>
            <a href="{{ route('admin.projects.create') }}" class="btn btn-primary">Novo Projeto</a>
        </div>
        <div class="bg-white shadow rounded-lg p-4">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Título</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Destaque</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Ordem</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Ações</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($projects as $project)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $project->title }}</div>
                                @if($project->short_description)
                                    <div class="text-xs text-gray-500 mt-1">{{ Str::limit($project->short_description, 60) }}</div>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full
                                    {{ $project->status === 'completed' ? 'bg-green-100 text-green-800' : 
                                       ($project->status === 'in_progress' ? 'bg-yellow-100 text-yellow-800' : 'bg-gray-100 text-gray-800') }}">
                                    {{ $project->status === 'completed' ? 'Concluído' : 
                                       ($project->status === 'in_progress' ? 'Em Andamento' : 'Planejado') }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                @if($project->featured)
                                    <span class="inline-flex items-center px-2 py-1 text-xs font-semibold bg-blue-100 text-blue-800 rounded-full">
                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                        </svg>
                                        Sim
                                    </span>
                                @else
                                    <span class="text-xs text-gray-500">Não</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-900">
                                {{ $project->order ?: '-' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <div class="flex gap-1 justify-center items-center">
                                    <a href="{{ route('admin.projects.show', $project) }}" 
                                       class="inline-flex items-center justify-center w-8 h-8 text-blue-700 bg-blue-100 hover:bg-blue-200 rounded-lg transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-1"
                                       title="Visualizar projeto">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                    </a>
                                    <a href="{{ route('admin.projects.edit', $project) }}" 
                                       class="inline-flex items-center justify-center w-8 h-8 text-amber-700 bg-amber-100 hover:bg-amber-200 rounded-lg transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:ring-offset-1"
                                       title="Editar projeto">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                    </a>
                                    <button type="button" 
                                            class="inline-flex items-center justify-center w-8 h-8 text-red-700 bg-red-100 hover:bg-red-200 rounded-lg transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-1" 
                                            onclick="openDeleteModal({{ $project->id }}, '{{ addslashes($project->title) }}')"
                                            title="Excluir projeto">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                    <form id="delete-form-{{ $project->id }}" action="{{ route('admin.projects.destroy', $project) }}" method="POST" class="hidden">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-4">Nenhum projeto encontrado.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="mt-4">{{ $projects->links() }}</div>
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
                
                // Adiciona animação suave
                setTimeout(() => {
                    modal.querySelector('.bg-white').classList.add('animate-pulse');
                }, 10);
                
                // Previne scroll do body
                document.body.style.overflow = 'hidden';
            }
            
            function closeDeleteModal() {
                const modal = document.getElementById('deleteModal');
                modal.classList.add('hidden');
                projectToDelete = null;
                
                // Restaura scroll do body
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

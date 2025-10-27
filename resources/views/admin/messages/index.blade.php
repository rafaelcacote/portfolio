@extends('admin.layouts.app')

@section('title', 'Mensagens de Contato')

@section('content')
    <div class="container mx-auto py-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Mensagens de Contato</h1>
            <div class="flex gap-2">
                <span class="inline-flex items-center px-3 py-1 text-sm font-medium text-blue-700 bg-blue-100 rounded-full">
                    Total: {{ $messages->total() }}
                </span>
            </div>
        </div>

        <div class="bg-white shadow rounded-lg p-4">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Remetente</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Assunto</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Data</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Ações</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($messages as $message)
                        <tr class="hover:bg-gray-50 {{ $message->status === 'new' ? 'bg-blue-50' : '' }}">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $message->name }}</div>
                                <div class="text-xs text-gray-500">{{ $message->email }}</div>
                                @if($message->phone)
                                    <div class="text-xs text-gray-500">{{ $message->phone }}</div>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm font-medium text-gray-900">{{ Str::limit($message->subject, 40) }}</div>
                                <div class="text-xs text-gray-500 mt-1">{{ Str::limit($message->message, 60) }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full
                                    {{ $message->status === 'new' ? 'bg-blue-100 text-blue-800' : 
                                       ($message->status === 'read' ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800') }}">
                                    {{ $message->status === 'new' ? 'Nova' : 
                                       ($message->status === 'read' ? 'Lida' : 'Respondida') }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-900">
                                {{ $message->created_at->format('d/m/Y H:i') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <div class="flex gap-1 justify-center items-center">
                                    <a href="{{ route('admin.messages.show', $message) }}" 
                                       class="inline-flex items-center justify-center w-8 h-8 text-blue-700 bg-blue-100 hover:bg-blue-200 rounded-lg transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-1"
                                       title="Visualizar mensagem">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                    </a>
                                    
                                    @if($message->status === 'new')
                                        <form action="{{ route('admin.messages.read', $message) }}" method="POST" class="inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" 
                                                    class="inline-flex items-center justify-center w-8 h-8 text-green-700 bg-green-100 hover:bg-green-200 rounded-lg transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-1"
                                                    title="Marcar como lida">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                </svg>
                                            </button>
                                        </form>
                                    @endif

                                    @if($message->status === 'read')
                                        <form action="{{ route('admin.messages.reply', $message) }}" method="POST" class="inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" 
                                                    class="inline-flex items-center justify-center w-8 h-8 text-purple-700 bg-purple-100 hover:bg-purple-200 rounded-lg transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-1"
                                                    title="Marcar como respondida">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"></path>
                                                </svg>
                                            </button>
                                        </form>
                                    @endif

                                    <button type="button" 
                                            class="inline-flex items-center justify-center w-8 h-8 text-red-700 bg-red-100 hover:bg-red-200 rounded-lg transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-1" 
                                            onclick="openDeleteModal({{ $message->id }}, '{{ addslashes($message->subject) }}')"
                                            title="Excluir mensagem">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                    <form id="delete-form-{{ $message->id }}" action="{{ route('admin.messages.destroy', $message) }}" method="POST" class="hidden">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-8">
                                <div class="text-gray-500">
                                    <svg class="w-12 h-12 mx-auto mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                    </svg>
                                    <p class="text-lg font-medium">Nenhuma mensagem encontrada</p>
                                    <p class="text-sm">As mensagens de contato aparecerão aqui</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="mt-4">{{ $messages->links() }}</div>
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
                            Tem certeza que deseja excluir a mensagem "<span id="modalMessageTitle" class="font-medium text-gray-900"></span>"?
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
            let messageToDelete = null;
            
            function openDeleteModal(id, title) {
                messageToDelete = id;
                document.getElementById('modalMessageTitle').textContent = title;
                const modal = document.getElementById('deleteModal');
                modal.classList.remove('hidden');
                document.body.style.overflow = 'hidden';
            }
            
            function closeDeleteModal() {
                const modal = document.getElementById('deleteModal');
                modal.classList.add('hidden');
                messageToDelete = null;
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
                    if (messageToDelete) {
                        document.getElementById('delete-form-' + messageToDelete).submit();
                    }
                });
            });
        </script>
    </div>
@endsection

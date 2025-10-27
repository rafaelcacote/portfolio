@extends('admin.layouts.app')

@section('title', 'Visualizar Mensagem')

@section('content')
    <div class="container mx-auto py-6">
        <div class="bg-white shadow rounded-lg p-6">
            <h1 class="text-2xl font-bold mb-2">Mensagem de {{ $message->name }}</h1>
            <div class="mb-2 text-gray-600">E-mail: {{ $message->email }}</div>
            <div class="mb-2 text-gray-600">Telefone: {{ $message->phone ?? '-' }}</div>
            <div class="mb-2 text-gray-600">Assunto: {{ $message->subject }}</div>
            <div class="mb-2 text-gray-600">Tipo de Projeto: {{ $message->project_type ?? '-' }}</div>
            <div class="mb-2 text-gray-600">Orçamento: {{ $message->budget_range ?? '-' }}</div>
            <div class="mb-2 text-gray-600">Prazo: {{ $message->timeline ?? '-' }}</div>
            <div class="mb-2 text-gray-600">Status: <span
                    class="badge {{ $message->status === 'new' ? 'bg-yellow-500' : 'bg-gray-400' }}">{{ ucfirst($message->status) }}</span>
            </div>
            <div class="mb-2 text-gray-600">Recebida em: {{ $message->created_at->format('d/m/Y H:i') }}</div>
            <div class="mb-4 text-gray-800"><strong>Mensagem:</strong><br>{{ $message->message }}</div>
            <div class="mb-4">
                <form action="{{ route('admin.messages.read', $message) }}" method="POST" class="inline">
                    @csrf
                    @method('PATCH')
                    <button class="btn btn-sm btn-success">Marcar como Lida</button>
                </form>
                <form action="{{ route('admin.messages.reply', $message) }}" method="POST" class="inline ml-2">
                    @csrf
                    @method('PATCH')
                    <button class="btn btn-sm btn-primary">Marcar como Respondida</button>
                </form>
            </div>
            <div class="mt-6 flex gap-2">
                <form action="{{ route('admin.messages.destroy', $message) }}" method="POST"
                    onsubmit="return confirm('Tem certeza?')">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger">Excluir</button>
                </form>
                <a href="{{ route('admin.messages.index') }}" class="btn btn-secondary">Voltar</a>
            </div>
        </div>
    </div>
@endsection

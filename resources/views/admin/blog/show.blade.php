@extends('admin.layouts.app')

@section('title', $post->title)

@section('content')
    <div class="container mx-auto py-6">
        <div class="bg-white shadow rounded-lg p-6">
            <h1 class="text-2xl font-bold mb-2">{{ $post->title }}</h1>
            <div class="mb-2 text-gray-600">Status: <span
                    class="badge {{ $post->status === 'published' ? 'bg-green-500' : 'bg-gray-400' }}">{{ ucfirst($post->status) }}</span>
            </div>
            <div class="mb-2 text-gray-600">Publicado em:
                {{ $post->published_at ? $post->published_at->format('d/m/Y H:i') : '-' }}</div>
            <div class="mb-2 text-gray-600">Tags: {{ $post->tags ? implode(', ', $post->tags) : '-' }}</div>
            @if ($post->featured_image)
                <img src="{{ asset('storage/' . $post->featured_image) }}" alt="Imagem de destaque" class="h-48 mb-4">
            @endif
            <div class="prose max-w-none">{!! nl2br(e($post->content)) !!}</div>
            <div class="mt-6 flex gap-2">
                <a href="{{ route('admin.blog.edit', $post) }}" class="btn btn-warning">Editar</a>
                <form action="{{ route('admin.blog.destroy', $post) }}" method="POST"
                    onsubmit="return confirm('Tem certeza?')">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger">Excluir</button>
                </form>
                <a href="{{ route('admin.blog.index') }}" class="btn btn-secondary">Voltar</a>
            </div>
        </div>
    </div>
@endsection

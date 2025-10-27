@extends('admin.layouts.app')

@section('title', 'Novo Post')

@section('content')
    <div class="container mx-auto py-6">
        <h1 class="text-2xl font-bold mb-4">Novo Post</h1>
        <form action="{{ route('admin.blog.store') }}" method="POST" enctype="multipart/form-data"
            class="bg-white shadow rounded-lg p-6">
            @csrf
            <div class="mb-4">
                <label class="block font-semibold mb-1">Título</label>
                <input type="text" name="title" class="form-input w-full" value="{{ old('title') }}" required>
            </div>
            <div class="mb-4">
                <label class="block font-semibold mb-1">Slug</label>
                <input type="text" name="slug" class="form-input w-full" value="{{ old('slug') }}">
            </div>
            <div class="mb-4">
                <label class="block font-semibold mb-1">Resumo</label>
                <textarea name="excerpt" class="form-textarea w-full" rows="2">{{ old('excerpt') }}</textarea>
            </div>
            <div class="mb-4">
                <label class="block font-semibold mb-1">Conteúdo</label>
                <textarea name="content" class="form-textarea w-full" rows="8">{{ old('content') }}</textarea>
            </div>
            <div class="mb-4">
                <label class="block font-semibold mb-1">Imagem de Destaque</label>
                <input type="file" name="featured_image" class="form-input w-full">
            </div>
            <div class="mb-4">
                <label class="block font-semibold mb-1">Tags (separadas por vírgula)</label>
                <input type="text" name="tags" class="form-input w-full" value="{{ old('tags') }}">
            </div>
            <div class="mb-4">
                <label class="block font-semibold mb-1">Status</label>
                <select name="status" class="form-select w-full">
                    <option value="draft">Rascunho</option>
                    <option value="published">Publicado</option>
                </select>
            </div>
            <div class="mb-4">
                <label class="block font-semibold mb-1">Data de Publicação</label>
                <input type="datetime-local" name="published_at" class="form-input w-full"
                    value="{{ old('published_at') }}">
            </div>
            <button type="submit" class="btn btn-primary">Salvar</button>
            <a href="{{ route('admin.blog.index') }}" class="btn btn-secondary ml-2">Cancelar</a>
        </form>
    </div>
@endsection

@extends('admin.layouts.app')

@section('title', 'Posts do Blog')

@section('content')
    <div class="container mx-auto py-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Posts do Blog</h1>
            <a href="{{ route('admin.blog.create') }}" class="btn btn-primary">Novo Post</a>
        </div>
        <div class="bg-white shadow rounded-lg p-4">
            <table class="min-w-full divide-y divide-gray-200">
                <thead>
                    <tr>
                        <th class="px-4 py-2">Título</th>
                        <th class="px-4 py-2">Status</th>
                        <th class="px-4 py-2">Publicado em</th>
                        <th class="px-4 py-2">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($posts as $post)
                        <tr>
                            <td class="px-4 py-2">{{ $post->title }}</td>
                            <td class="px-4 py-2">
                                <span
                                    class="badge {{ $post->status === 'published' ? 'bg-green-500' : 'bg-gray-400' }}">{{ ucfirst($post->status) }}</span>
                            </td>
                            <td class="px-4 py-2">{{ $post->published_at ? $post->published_at->format('d/m/Y H:i') : '-' }}
                            </td>
                            <td class="px-4 py-2 flex gap-2">
                                <a href="{{ route('admin.blog.edit', $post) }}" class="btn btn-sm btn-warning">Editar</a>
                                <a href="{{ route('admin.blog.show', $post) }}" class="btn btn-sm btn-info">Ver</a>
                                <form action="{{ route('admin.blog.destroy', $post) }}" method="POST"
                                    onsubmit="return confirm('Tem certeza?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">Excluir</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-4">Nenhum post encontrado.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="mt-4">{{ $posts->links() }}</div>
        </div>
    </div>
@endsection

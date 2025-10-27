@extends('admin.layouts.app')

@section('title', 'Novo Projeto')

@section('content')
    <div class="container mx-auto py-6">
        <h1 class="text-2xl font-bold mb-4">Novo Projeto</h1>
        <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data" class="bg-white shadow rounded-lg p-6">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block font-semibold mb-1">Título</label>
                    <input type="text" name="title" class="form-input w-full" value="{{ old('title') }}" required>
                </div>
                <div>
                    <label class="block font-semibold mb-1">Tecnologias (separadas por vírgula)</label>
                    <input type="text" name="technologies" class="form-input w-full" value="{{ old('technologies') }}">
                </div>
                <div class="md:col-span-2">
                    <label class="block font-semibold mb-1">Descrição Curta</label>
                    <textarea name="short_description" class="form-textarea w-full" rows="2">{{ old('short_description') }}</textarea>
                </div>
                <div class="md:col-span-2">
                    <label class="block font-semibold mb-1">Descrição Completa</label>
                    <textarea name="description" class="form-textarea w-full" rows="6">{{ old('description') }}</textarea>
                </div>
                <div>
                    <label class="block font-semibold mb-1">Imagem de Capa</label>
                    <input type="file" name="image" accept="image/jpeg,image/png,image/jpg,image/gif,image/webp" class="form-input w-full">
                    <p class="text-sm text-gray-500 mt-1">Formatos aceitos: JPEG, PNG, JPG, GIF, WEBP (máx. 5MB)</p>
                    <div id="image-preview" class="mt-2 hidden">
                        <img id="preview-img" src="" alt="Preview" class="h-32 w-32 object-cover rounded border">
                    </div>
                </div>
                <div>
                    <label class="block font-semibold mb-1">Galeria de Imagens</label>
                    <input type="file" name="gallery[]" accept="image/jpeg,image/png,image/jpg,image/gif,image/webp" multiple class="form-input w-full">
                    <p class="text-sm text-gray-500 mt-1">Formatos aceitos: JPEG, PNG, JPG, GIF, WEBP (máx. 5MB cada)</p>
                    <div id="gallery-preview" class="mt-2 flex flex-wrap gap-2 hidden">
                        <!-- Preview das imagens será inserido aqui -->
                    </div>
                </div>
                <div>
                    <label class="block font-semibold mb-1">URL do Projeto</label>
                    <input type="url" name="project_url" class="form-input w-full" value="{{ old('project_url') }}">
                </div>
                <div>
                    <label class="block font-semibold mb-1">URL do GitHub</label>
                    <input type="url" name="github_url" class="form-input w-full" value="{{ old('github_url') }}">
                </div>
                <div>
                    <label class="block font-semibold mb-1">URL de Demonstração</label>
                    <input type="url" name="demo_url" class="form-input w-full" value="{{ old('demo_url') }}">
                </div>
                <div>
                    <label class="block font-semibold mb-1">Status</label>
                    <select name="status" class="form-select w-full">
                        <option value="completed">Concluído</option>
                        <option value="in_progress">Em andamento</option>
                        <option value="planned">Planejado</option>
                    </select>
                </div>
                <div>
                    <label class="block font-semibold mb-1">Data de Conclusão</label>
                    <input type="date" name="completion_date" class="form-input w-full" value="{{ old('completion_date') }}">
                </div>
                <div class="flex items-center space-x-4">
                    <label class="block font-semibold mb-1">Destaque?</label>
                    <input type="checkbox" name="featured" value="1" {{ old('featured') ? 'checked' : '' }}> Sim
                </div>
                <div>
                    <label class="block font-semibold mb-1">Ordem</label>
                    <input type="number" name="order" class="form-input w-full" value="{{ old('order', 0) }}">
                </div>
                <div class="flex items-center space-x-4">
                    <label class="block font-semibold mb-1">Ativo?</label>
                    <input type="checkbox" name="active" value="1" {{ old('active', 1) ? 'checked' : '' }}> Sim
                </div>
            </div>
            <div class="mt-6 flex items-center">
                <button type="submit" class="btn btn-primary">Salvar</button>
                <a href="{{ route('admin.projects.index') }}" class="btn btn-secondary ml-2">Cancelar</a>
            </div>
        </form>
    </div>
@endsection

<script>
    // Preview da imagem de capa
    document.querySelector('input[name="image"]').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const preview = document.getElementById('image-preview');
                const img = document.getElementById('preview-img');
                img.src = e.target.result;
                preview.classList.remove('hidden');
            };
            reader.readAsDataURL(file);
        } else {
            document.getElementById('image-preview').classList.add('hidden');
        }
    });

    // Preview da galeria de imagens
    document.querySelector('input[name="gallery[]"]').addEventListener('change', function(e) {
        const files = e.target.files;
        const preview = document.getElementById('gallery-preview');
        
        if (files.length > 0) {
            preview.innerHTML = '';
            preview.classList.remove('hidden');
            
            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.className = 'h-24 w-24 object-cover rounded border';
                    preview.appendChild(img);
                };
                reader.readAsDataURL(file);
            }
        } else {
            preview.classList.add('hidden');
        }
    });
</script>

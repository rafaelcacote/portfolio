<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Project::query();
        
        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('short_description', 'like', "%{$search}%");
            });
        }
        
        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        
        // Filter by featured
        if ($request->filled('featured')) {
            $query->where('featured', $request->featured === '1');
        }
        
        $projects = $query->latest()->paginate(15);
        
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.projects.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'short_description' => 'required|string|max:500',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'gallery.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'technologies' => 'required|string',
            'project_url' => 'nullable|url',
            'github_url' => 'nullable|url',
            'demo_url' => 'nullable|url',
            'status' => 'required|in:planned,in_progress,completed,cancelled',
            'completion_date' => 'nullable|date',
            'featured' => 'boolean',
            'active' => 'boolean',
            'order' => 'nullable|integer'
        ], [
            'image.image' => 'O arquivo deve ser uma imagem (jpeg, png, jpg, gif ou webp).',
            'image.max' => 'A imagem deve ter no máximo 5MB.',
            'gallery.*.image' => 'Todos os arquivos da galeria devem ser imagens.',
            'gallery.*.max' => 'Cada imagem da galeria deve ter no máximo 5MB.',
        ]);
        
        // Process technologies
        $validated['technologies'] = array_map('trim', explode(',', $validated['technologies']));
        
        // Handle image upload
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('projects', 'public');
        }
        
        // Handle gallery upload
        if ($request->hasFile('gallery')) {
            $galleryPaths = [];
            foreach ($request->file('gallery') as $file) {
                $galleryPaths[] = $file->store('projects/gallery', 'public');
            }
            $validated['gallery'] = $galleryPaths;
        }
        
        Project::create($validated);
        
        return redirect()->route('admin.projects.index')
                        ->with('success', 'Projeto criado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        return view('admin.projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'short_description' => 'required|string|max:500',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'gallery.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'technologies' => 'required|string',
            'project_url' => 'nullable|url',
            'github_url' => 'nullable|url',
            'demo_url' => 'nullable|url',
            'status' => 'required|in:planned,in_progress,completed,cancelled',
            'completion_date' => 'nullable|date',
            'featured' => 'boolean',
            'active' => 'boolean',
            'order' => 'nullable|integer'
        ], [
            'image.image' => 'O arquivo deve ser uma imagem (jpeg, png, jpg, gif ou webp).',
            'image.max' => 'A imagem deve ter no máximo 5MB.',
            'gallery.*.image' => 'Todos os arquivos da galeria devem ser imagens.',
            'gallery.*.max' => 'Cada imagem da galeria deve ter no máximo 5MB.',
        ]);
        
        // Process technologies
        $validated['technologies'] = array_map('trim', explode(',', $validated['technologies']));
        
        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image
            if ($project->image) {
                Storage::disk('public')->delete($project->image);
            }
            $validated['image'] = $request->file('image')->store('projects', 'public');
        }
        
        // Handle gallery upload
        if ($request->hasFile('gallery')) {
            // Delete old gallery images
            if ($project->gallery) {
                foreach ($project->gallery as $imagePath) {
                    Storage::disk('public')->delete($imagePath);
                }
            }
            
            $galleryPaths = [];
            foreach ($request->file('gallery') as $file) {
                $galleryPaths[] = $file->store('projects/gallery', 'public');
            }
            $validated['gallery'] = $galleryPaths;
        }
        
        $project->update($validated);
        
        return redirect()->route('admin.projects.index')
                        ->with('success', 'Projeto atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        // Delete associated images
        if ($project->image) {
            Storage::disk('public')->delete($project->image);
        }
        
        if ($project->gallery) {
            foreach ($project->gallery as $imagePath) {
                Storage::disk('public')->delete($imagePath);
            }
        }
        
        $project->delete();
        
        return redirect()->route('admin.projects.index')
                        ->with('success', 'Projeto excluído com sucesso!');
    }
    
    /**
     * Toggle featured status
     */
    public function toggleFeatured(Project $project)
    {
        $project->update(['featured' => !$project->featured]);
        
        return back()->with('success', 'Status de destaque atualizado!');
    }
    
    /**
     * Toggle active status
     */
    public function toggleActive(Project $project)
    {
        $project->update(['active' => !$project->active]);
        
        return back()->with('success', 'Status ativo atualizado!');
    }
}


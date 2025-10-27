<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BlogPost;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;


class BlogPostController extends Controller
{
    public function index()
    {
        $posts = BlogPost::orderByDesc('published_at')->paginate(15);
        return view('admin.blog.index', compact('posts'));
    }

    public function create()
    {
        return view('admin.blog.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:blog_posts,slug',
            'excerpt' => 'nullable|string|max:500',
            'content' => 'required|string',
            'featured_image' => 'nullable|image',
            'tags' => 'nullable|string',
            'status' => 'required|in:draft,published',
            'published_at' => 'nullable|date',
        ]);

        $slug = $validated['slug'] ?? Str::slug($validated['title']);
        if (BlogPost::where('slug', $slug)->exists()) {
            return back()->withErrors(['slug' => 'Slug já existe.'])->withInput();
        }

        $data = $validated;
        $data['slug'] = $slug;
        $data['user_id'] = auth()->id();
        $data['tags'] = $request->tags ? array_map('trim', explode(',', $request->tags)) : [];

        if ($request->hasFile('featured_image')) {
            $data['featured_image'] = $request->file('featured_image')->store('blog', 'public');
        }

        $post = BlogPost::create($data);
        return redirect()->route('admin.blog.index')->with('success', 'Post criado com sucesso!');
    }

    public function show($id)
    {
        $post = BlogPost::findOrFail($id);
        return view('admin.blog.show', compact('post'));
    }

    public function edit($id)
    {
        $post = BlogPost::findOrFail($id);
        return view('admin.blog.edit', compact('post'));
    }

    public function update(Request $request, $id)
    {
        $blog = BlogPost::findOrFail($id);
        
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:blog_posts,slug,' . $blog->id,
            'excerpt' => 'nullable|string|max:500',
            'content' => 'required|string',
            'featured_image' => 'nullable|image',
            'tags' => 'nullable|string',
            'status' => 'required|in:draft,published',
            'published_at' => 'nullable|date',
        ]);

        $slug = $validated['slug'] ?? Str::slug($validated['title']);
        if (BlogPost::where('slug', $slug)->where('id', '!=', $blog->id)->exists()) {
            return back()->withErrors(['slug' => 'Slug já existe.'])->withInput();
        }

        $data = $validated;
        $data['slug'] = $slug;
        $data['tags'] = $request->tags ? array_map('trim', explode(',', $request->tags)) : [];

        if ($request->hasFile('featured_image')) {
            if ($blog->featured_image) {
                Storage::disk('public')->delete($blog->featured_image);
            }
            $data['featured_image'] = $request->file('featured_image')->store('blog', 'public');
        }

        $blog->update($data);
        return redirect()->route('admin.blog.index')->with('success', 'Post atualizado com sucesso!');
    }

    public function destroy($id)
    {
        $blog = BlogPost::findOrFail($id);
        
        if ($blog->featured_image) {
            Storage::disk('public')->delete($blog->featured_image);
        }
        $blog->delete();
        return redirect()->route('admin.blog.index')->with('success', 'Post excluído com sucesso!');
    }
}

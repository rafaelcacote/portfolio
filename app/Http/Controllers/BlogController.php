<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BlogPost;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $query = BlogPost::published()->recent();

        // Filtro por tag
        if ($request->has('tag') && $request->tag) {
            $query->whereJsonContains('tags', $request->tag);
        }

        // Busca por título
        if ($request->has('search') && $request->search) {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('excerpt', 'like', '%' . $request->search . '%');
            });
        }

        $posts = $query->paginate(9);

        // Posts em destaque
        $featuredPosts = BlogPost::published()->featured()->limit(3)->get();

        // Buscar todas as tags para o filtro
        $allTags = BlogPost::published()
            ->get()
            ->pluck('tags')
            ->flatten()
            ->unique()
            ->sort()
            ->values();

        return view('blog.index', compact('posts', 'featuredPosts', 'allTags'));
    }

    public function show(BlogPost $blogPost)
    {
        // Verificar se o post está publicado
        if ($blogPost->status !== 'published' || $blogPost->published_at > now()) {
            abort(404);
        }

        // Incrementar visualizações
        $blogPost->incrementViews();

        // Posts relacionados (mesmas tags)
        $relatedPosts = BlogPost::published()
            ->where('id', '!=', $blogPost->id)
            ->where(function($query) use ($blogPost) {
                if ($blogPost->tags) {
                    foreach ($blogPost->tags as $tag) {
                        $query->orWhereJsonContains('tags', $tag);
                    }
                }
            })
            ->limit(3)
            ->get();

        return view('blog.show', compact('blogPost', 'relatedPosts'));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\BlogPost;

class HomeController extends Controller
{
    public function index()
    {
        // Buscar projetos em destaque
        $featuredProjects = Project::active()
            ->featured()
            ->completed()
            ->ordered()
            ->limit(6)
            ->get();

        // Buscar posts recentes do blog
        $recentPosts = BlogPost::published()
            ->recent()
            ->limit(3)
            ->get();

        // Estatísticas para a página inicial
        $stats = [
            'projects_completed' => Project::completed()->count(),
            'blog_posts' => BlogPost::published()->count(),
            'years_experience' => now()->year - 2020, // Ajuste conforme necessário
        ];

        return view('home.index', compact('featuredProjects', 'recentPosts', 'stats'));
    }

    public function about()
    {
        return view('home.about');
    }

    public function services()
    {
        return view('home.services');
    }
}

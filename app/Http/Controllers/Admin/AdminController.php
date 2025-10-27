<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\BlogPost;
use App\Models\ContactMessage;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Estatísticas gerais
        $stats = [
            'total_projects' => Project::count(),
            'active_projects' => Project::active()->count(),
            'featured_projects' => Project::featured()->count(),
            'completed_projects' => Project::completed()->count(),
            
            'total_posts' => BlogPost::count(),
            'published_posts' => BlogPost::published()->count(),
            'draft_posts' => BlogPost::where('status', 'draft')->count(),
            'featured_posts' => BlogPost::featured()->count(),
            
            'total_messages' => ContactMessage::count(),
            'new_messages' => ContactMessage::new()->count(),
            'unread_messages' => ContactMessage::unread()->count(),
        ];
        
        // Projetos recentes
        $recentProjects = Project::latest()->limit(5)->get();
        
        // Posts recentes
        $recentPosts = BlogPost::latest()->limit(5)->get();
        
        // Mensagens recentes
        $recentMessages = ContactMessage::recent()->limit(5)->get();
        
        // Estatísticas mensais (últimos 6 meses)
        $monthlyStats = [];
        for ($i = 5; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $monthlyStats[] = [
                'month' => $date->format('M/Y'),
                'projects' => Project::whereYear('created_at', $date->year)
                                   ->whereMonth('created_at', $date->month)
                                   ->count(),
                'posts' => BlogPost::whereYear('created_at', $date->year)
                                 ->whereMonth('created_at', $date->month)
                                 ->count(),
                'messages' => ContactMessage::whereYear('created_at', $date->year)
                                          ->whereMonth('created_at', $date->month)
                                          ->count(),
            ];
        }
        
        return view('admin.dashboard', compact(
            'stats', 
            'recentProjects', 
            'recentPosts', 
            'recentMessages',
            'monthlyStats'
        ));
    }
}

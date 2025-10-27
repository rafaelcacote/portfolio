<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

class PortfolioController extends Controller
{
    public function index(Request $request)
    {
        $query = Project::active()->completed()->ordered();

        // Filtro por tecnologia
        if ($request->has('technology') && $request->technology) {
            $query->whereJsonContains('technologies', $request->technology);
        }

        // Filtro por status
        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }

        $projects = $query->paginate(12);

        // Buscar todas as tecnologias para o filtro
        $allTechnologies = Project::active()
            ->get()
            ->pluck('technologies')
            ->flatten()
            ->unique()
            ->sort()
            ->values();

        return view('portfolio.index', compact('projects', 'allTechnologies'));
    }

    public function show($id)
    {
        $project = Project::active()->findOrFail($id);
        
        // Buscar projetos relacionados (mesmas tecnologias)
        $relatedProjects = Project::active()
            ->completed()
            ->where('id', '!=', $project->id)
            ->where(function($query) use ($project) {
                foreach ($project->technologies as $tech) {
                    $query->orWhereJsonContains('technologies', $tech);
                }
            })
            ->limit(3)
            ->get();

        return view('portfolio.show', compact('project', 'relatedProjects'));
    }
}

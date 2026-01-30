<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Project;
use App\Models\Experience;
use App\Models\Education;
use App\Models\ContactMessage;
use Inertia\Inertia;

class PortfolioController extends Controller
{
    public function index()
    {
        $projects = Project::orderBy('order')->get();
        $experiences = Experience::orderBy('start_date', 'desc')->get();
        return Inertia::render('Portfolio/Index', [
            'projects' => $projects,
            'experiences' => $experiences
        ]);
    }

    public function show($slug)
    {
        $project = Project::where('slug', $slug)->firstOrFail();
        
        $nextProject = Project::where('order', '>', $project->order)
            ->orderBy('order')
            ->first() ?? Project::orderBy('order')->first();
            
        return Inertia::render('Portfolio/ProjectDetail', [
            'project' => $project,
            'nextProject' => $nextProject
        ]);
    }

    public function education()
    {
        $educations = Education::orderBy('order')->orderBy('id', 'desc')->get();
        return Inertia::render('Portfolio/Education', [
            'educations' => $educations
        ]);
    }

    public function storeContact(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        ContactMessage::create(array_merge($validated, ['status' => 'pending']));

        return back()->with('success', 'Message sent successfully!');
    }
}

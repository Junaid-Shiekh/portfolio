<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ContactMessage;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/Dashboard', [
            'stats' => [
                'projectsCount' => Project::count(),
                'messagesCount' => ContactMessage::count(),
            ],
            'recentProjects' => Project::orderBy('created_at', 'desc')->take(3)->get(),
            'recentMessages' => ContactMessage::orderBy('created_at', 'desc')->take(3)->get(),
        ]);
    }
}

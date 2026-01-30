<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $projects = [
            [
                'title' => 'HRM System Pro',
                'description' => 'A comprehensive Human Resource Management system with employee tracking, payroll, and leave management.',
                'image' => 'https://images.unsplash.com/photo-1454165833767-02755157f8fe?q=80&w=2070&auto=format&fit=crop',
                'tech_stack' => ['Laravel', 'Vue 3', 'Inertia.js', 'MySQL', 'Tailwind CSS'],
                'live_url' => 'https://example.com/hrm',
                'github_url' => 'https://github.com/example/hrm',
                'order' => 1,
            ],
            [
                'title' => 'Advanced CRM Dashboard',
                'description' => 'Customer Relationship Management dashboard featuring real-time analytics, lead management, and automated reporting.',
                'image' => 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?q=80&w=2070&auto=format&fit=crop',
                'tech_stack' => ['Laravel', 'Vue 3', 'Inertia.js', 'Redis', 'Tailwind CSS'],
                'live_url' => 'https://example.com/crm',
                'github_url' => 'https://github.com/example/crm',
                'order' => 2,
            ],
            [
                'title' => 'Invoice Management API',
                'description' => 'A robust REST API for managing invoices, payments, and client subscriptions with PDF generation.',
                'image' => 'https://images.unsplash.com/photo-1554224155-1209b5559c55?q=80&w=2070&auto=format&fit=crop',
                'tech_stack' => ['Laravel', 'Postman', 'MySQL', 'Stripe'],
                'live_url' => 'https://example.com/invoice-api',
                'github_url' => 'https://github.com/example/invoice-api',
                'order' => 3,
            ],
        ];

        foreach ($projects as $project) {
            \App\Models\Project::create($project);
        }
    }
}

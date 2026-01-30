<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Education;
use Illuminate\Http\Request;
use Inertia\Inertia;

class EducationController extends Controller
{
    public function index()
    {
        $educations = Education::orderBy('order')->orderBy('id', 'desc')->get();
        return Inertia::render('Admin/Education/Index', [
            'educations' => $educations
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/Education/Create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'degree' => 'required|string|max:255',
            'institution' => 'required|string|max:255',
            'field_of_study' => 'required|string|max:255',
            'start_date' => 'required|string|max:255',
            'end_date' => 'nullable|string|max:255|required_without:is_current',
            'is_current' => 'boolean',
            'cgpa' => 'nullable|string|max:255',
            'order' => 'nullable|integer',
        ]);

        if (isset($validated['is_current']) && $validated['is_current']) {
            $validated['end_date'] = null;
        }

        Education::create($validated);

        return redirect()->route('admin.education.index')->with('success', 'Education added successfully.');
    }

    public function edit(Education $education)
    {
        return Inertia::render('Admin/Education/Edit', [
            'education' => $education
        ]);
    }

    public function update(Request $request, Education $education)
    {
        $validated = $request->validate([
            'degree' => 'required|string|max:255',
            'institution' => 'required|string|max:255',
            'field_of_study' => 'required|string|max:255',
            'start_date' => 'required|string|max:255',
            'end_date' => 'nullable|string|max:255|required_without:is_current',
            'is_current' => 'boolean',
            'cgpa' => 'nullable|string|max:255',
            'order' => 'nullable|integer',
        ]);

        if (isset($validated['is_current']) && $validated['is_current']) {
            $validated['end_date'] = null;
        }

        $education->update($validated);

        return redirect()->route('admin.education.index')->with('success', 'Education updated successfully.');
    }

    public function destroy(Education $education)
    {
        $education->delete();
        return redirect()->route('admin.education.index')->with('success', 'Education deleted successfully.');
    }
}

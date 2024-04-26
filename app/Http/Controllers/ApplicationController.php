<?php

namespace App\Http\Controllers;
use App\Models\Application;
use App\Exports\ApplicationsExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $applications = Application::query();

        foreach (['nom', 'version', 'status'] as $field) {
            if ($request->filled($field)) {
                $applications->where($field, 'like', "%{$request->$field}%");
            }
        }

        if ($request->has('search')) {
            $applications->where(function ($query) use ($request) {
                $query->where('nom', 'like', "%{$request->search}%")
                      ->orWhere('version', 'like', "%{$request->search}%");
            });
        }
        $applications = $applications->paginate(10);
        return view('Application', compact('applications'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request )
    {
        \Log::info('Received export request:', $request->all());
        return Excel::download(new ApplicationsExport($request), 'Applications.xlsx');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'version' => 'required|string',
        ]);

        Application::create($validated);

        return redirect()->route('applications.index')->with('success', 'Application added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $application = Application::findOrFail($id);
        return view('applications.show', compact('application'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $application = Application::findOrFail($id);
        return view('add_Application', compact('application'));;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $application = Application::findOrFail($id);
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'version' => 'required|string',
        ]);

        $application->update($validated);

        return redirect()->route('applications.index')->with('success', 'Application updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Application::destroy($id);

        return redirect()->route('applications.index')->with('success', 'Application deleted successfully.');
    }
    public function export()
    {
        return Excel::download(new ApplicationsExport, 'applications.xlsx');
    }
}

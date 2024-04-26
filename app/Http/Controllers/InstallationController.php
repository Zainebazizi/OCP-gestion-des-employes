<?php

namespace App\Http\Controllers;
use App\Models\Installation;
use App\Exports\InstallationsExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class InstallationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $installations = Installation::query();

        foreach (['application_id', 'telephone_id', 'date_installation'] as $field) {
            if ($request->filled($field)) {
                $installations->where($field, $request->$field);
            }
        }

        if ($request->has('search')) {
            $installations->whereHas('application', function($query) use ($request) {
                $query->where('nom', 'like', '%' . $request->search . '%')
                      ->orWhere('version', 'like', '%' . $request->search . '%');
            })->orWhereHas('telephone', function($query) use ($request) {
                $query->where('marque', 'like', '%' . $request->search . '%')
                      ->orWhere('modele', 'like', '%' . $request->search . '%')
                      ->orWhere('num_série', 'like', '%' . $request->search . '%');
            });
        }
        $installations = $installations->paginate(10);
        return view('installations.index', compact('installations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('installations.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'telephone_id' => 'required|exists:telephones,id',
            'application_id' => 'required|exists:applications,id',
            'date_installation' => 'required|date',
        ]);

        $installation = Installation::create($request->all());
        return redirect()->route('installations.index')->with('success', 'installation added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $installation = Installation::with(['application', 'telephone'])->findOrFail($id);
        return view('installations.show', compact('installation'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $installation = Installation::with(['application', 'telephone'])->findOrFail($id);
        return view('installations.edit', compact('installation'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $installation = Installation::findOrFail($id);
        $validated = $request->validate([
            'telephone_id' => 'required|exists:telephones,id',
            'application_id' => 'required|exists:applications,id',
            'date_installation' => 'required|date',
        ]);

        $installation->update($request->all());
        return redirect()->route('installations.index')->with('success', 'installation updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Installation::destroy($id);
        return redirect()->route('installations.index')->with('success', 'Installation deleted successfully.');
    }
    public function export()
    {
        return Excel::download(new InstallationsExport, 'installations.xlsx');
    }
}

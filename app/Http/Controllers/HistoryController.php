<?php

namespace App\Http\Controllers;
use App\Models\History;
use App\Exports\HistoriesExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class HistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $histories = History::query();

        foreach (['employee_id', 'telephone_id', 'application_id', 'date_debut', 'date_fin'] as $field) {
            if ($request->filled($field)) {
                $histories->where($field, $request->$field);
            }
        }

        if ($request->has('search')) {
            $histories->where(function ($query) use ($request) {
                $query->orWhereHas('employee', function ($q) use ($request) {
                    $q->where('nom', 'like', "%{$request->search}%")
                      ->orWhere('prenom', 'like', "%{$request->search}%");
                })
                ->orWhereHas('telephone', function ($q) use ($request) {
                    $q->where('marque', 'like', "%{$request->search}%")
                      ->orWhere('modele', 'like', "%{$request->search}%");
                });
            });
        }
        $histories = $histories->paginate(10);
        return view('histories.index', compact('histories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('histories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'telephone_id' => 'required|exists:telephones,id',
            'application_id' => 'required|exists:applications,id',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after_or_equal:date_debut'
        ]);

        $history = History::create($request->all());

        return redirect()->route('histories.index')->with('success', 'History added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $history = History::with(['employee', 'telephone', 'application'])->findOrFail($id);
        return view('histories.show', compact('history'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $history = History::with(['employee', 'telephone', 'application'])->findOrFail($id);
        return view('histories.edit', compact('history'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $history = History::findOrFail($id);
        $validated = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'telephone_id' => 'required|exists:telephones,id',
            'application_id' => 'required|exists:applications,id',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after_or_equal:date_debut'
        ]);

        $history->update($request->all());

        return redirect()->route('histories.index')->with('success', 'History updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        History::destroy($id);

        return redirect()->route('histories.index')->with('success', 'History deleted successfully.');
    }
    public function export()
    {
        return Excel::download(new HistoriesExport, 'histories.xlsx');
    }
}

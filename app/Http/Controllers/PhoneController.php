<?php
namespace App\Http\Controllers;
use App\Models\Telephone;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\TelephonesExport;

class PhoneController extends Controller
{
    public function index(Request $request)
    {
        $telephones = Telephone::query();
        if ($request->filled('search')) {
            $search = $request->search;
            $telephones->where(function ($query) use ($search) {
                $query->where('marque', 'like', "%{$search}%")
                    ->orWhere('modele', 'like', "%{$search}%")
                    ->orWhere('status', 'like', "%{$search}%")
                    ->orWhere('num_série', 'like', "%{$search}%");
            });
        }
        
        foreach (['marque', 'modele', 'status', 'num_série'] as $field) {
            if ($request->filled($field)) {
                $telephones->where($field, 'like', "%{$request->$field}%");
            }
        }

        
        $telephones = $telephones->paginate(10);
        return view('téléphone', compact('telephones'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        \Log::info('Received export request:', $request->all());
        return Excel::download(new TelephonesExport($request), 'telephones.xlsx');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $donnees=([
            'marque' =>$request->marque,
            'modele' =>$request->modele,
            'num_série' =>$request->num_série,
            'status' =>$request->status,
        ]);
        $telephone = Telephone::create($donnees);

        return redirect()->route('phones.index')->with('success', 'Telephone added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $telephone = Telephone::findOrFail($id);
        return view('telephones.show', compact('telephone'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $telephone = Telephone::findOrFail($id);
        return view('add_téléphone', compact('telephone'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $telephone = Telephone::findOrFail($id);
        $donnees=([
            'marque' =>$request->marque,
            'modele' =>$request->modele,
            'numero_serie' =>$request->numero_serie,
            'status' =>$request->status,
        ]);
        

        $telephone->update($donnees);

        return redirect()->route('phones.index')->with('success', 'Telephone updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $telephone = Telephone::findOrFail($id);
        $telephone->delete();
        return redirect()->route('phones.index')->with('success', 'Telephone deleted successfully.');
    }
    public function export()
    {
        return Excel::download(new TelephonesExport, 'telephones.xlsx');
    }
}

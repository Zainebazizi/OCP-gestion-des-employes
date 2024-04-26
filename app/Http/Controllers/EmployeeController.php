<?php
namespace App\Http\Controllers;
use App\Models\Employee;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\EmployeesExport;
class EmployeeController extends Controller

{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // $employees = Employee::All();

        // // General Search: Checks across multiple fields
        // if ($request->filled('search')) {
        //     $search = $request->search;
        //     $employees->where(function ($query) use ($search) {
        //         $query->where('id', 'like', "%{$search}%")
        //               ->orWhere('nom', 'like', "%{$search}%")
        //               ->orWhere('prenom', 'like', "%{$search}%")
        //               ->orWhere('cin', 'like', "%{$search}%")
        //               ->orWhere('department', 'like', "%{$search}%")
        //               ->orWhere('region', 'like', "%{$search}%");
        //     });
        // }
        // // filtering
        // // AJAX filter handling
        // if ($request->ajax() && $request->has('filterBy')) {
        //     $field = $request->query('filterBy');
        //     // Ensure valid filtering field to prevent errors
        //     if (!in_array($field, ['id', 'nom', 'prenom', 'numero', 'department', 'region', 'cin'])) {
        //         return response()->json(['error' => 'Invalid field'], 400);
        //     }
    
        //     $employees = $employees->whereNotNull($field)->orderBy($field)->get();
        //     return response()->json($employees);
        // }
        // // end filtering
    
        //  //$employees = $employees->paginate(10);
        // return view('employé', compact('employees'));
        $employees = Employee::query();

    // General Search: Checks across multiple fields
    if ($request->filled('search')) {
        $search = $request->search;
        $employees->where(function ($query) use ($search) {
            $query->where('id', 'like', "%{$search}%")
                  ->orWhere('nom', 'like', "%{$search}%")
                  ->orWhere('prenom', 'like', "%{$search}%")
                  ->orWhere('cin', 'like', "%{$search}%")
                  ->orWhere('department', 'like', "%{$search}%")
                  ->orWhere('region', 'like', "%{$search}%");
        });
    }
     
   

    
    }
  
    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        \Log::info('Received export request:', $request->all());
        return Excel::download(new EmployeesExport($request), 'employees.xlsx');
}
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'numero' => 'required|string|max:15',
            'department' => 'required|string|max:255',
            'region' => 'required|string|max:255',
            'cin' => 'required|string|max:255|unique:employees,cin'
        ]);
        Employee::create($validated);
        return redirect()->route('employees.index')->with('success', 'Employee added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $employee = Employee::findOrFail($id);
        return view('employees.show', compact('employee'));
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $employee = Employee::findOrFail($id);
         return view('add_employé', compact('employee'));
        // return Excel::download(new EmployeesExport, 'employees.xlsx');
       
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
      
        $employee = Employee::findOrFail($id);
        $donnees=([
            'nom' =>$request->nom,
            'prenom' =>$request->prenom,
            'numero' =>$request->numero,
            'department' =>$request->department,
            'region' =>$request->region,
            'cin'=>$request->cin,
        ]);
        $employee->update($donnees);
        
        return redirect()->route('employees.index')->with('success', 'Employee updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Employee::destroy($id);
        return redirect()->route('employees.index')->with('success', 'Employee deleted successfully.');
    }
 

}

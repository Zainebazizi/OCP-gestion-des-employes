<?php

namespace App\Http\Controllers;
use App\Models\AffectationHistory;
use App\Models\Affectation;
use App\Models\Telephone;
use App\Models\Application;
use App\Exports\AffectationsExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Employee;



class AffectationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $affectations = Affectation::query();
        $Telephones = Telephone::all();
        $Employees= Employee::all();
        $Applications= Application::all();
        if ($request->has('search')) {
            $search = $request->input('search');
            $affectations = $affectations->where(function ($q) use ($search) {
                $q->where('nom_employee', 'like', "%$search%")
                    ->orWhere('telephone_N', 'like', "%$search%")
                    ->orWhere('date_debut', 'like', "%$search%")
                    ->orWhere('date_fin', 'like', "%$search%");
            });// Ajoutez get() ou paginate() à la fin pour exécuter la requête.
        }
        
        $affectations = $affectations->paginate(10);
        return view('Affectation', compact('affectations','Telephones','Employees','Applications'));
    }
    public function notifyAdminAboutAffectations()
    {
        // Récupérer la date actuelle
        $today = Carbon::now();

        // Récupérer la date dans 15 jours
        $targetDate = $today->addDays(15);

        // Récupérer les employés dont l'affectation se termine dans 15 jours
        $employees = Employee::whereHas('affectations', function ($query) use ($targetDate) {
            $query->where('date_fin', $targetDate);
        })->get();

        // Envoyer la notification à l'administrateur pour chaque employé
        foreach ($employees as $employee) {
            Notification::route('mail', 'JABLI.ZAKARIA@gmail.com')
                ->notify(new AffectationEndNotification($employee, $targetDate));
        }

        return response()->json(['message' => 'Notifications envoyées à l’administrateur'], 200);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create(request $request)
    {
      
        \Log::info('Received export request:', $request->all());
        return Excel::download(new AffectationsExport($request), 'Affectations.xlsx');
    }
    /**
     * Store a newly created resource in storage.
     */
   /**
 * Store a newly created resource in storage.
 */
public function store(Request $request)
{
   // Récupérer l'employé par son nom
   $employee = Employee::where('cin', $request->nom_employee)->first();

   // Vérifier si l'employé existe et a un département associé
   if ($employee && $employee->department) {
       // Récupérer le nom du département
       $departmentName = $employee->department;

       // Calculer la date de fin (date de début + 2 ans)
       $dateDebut = $request->date_debut;
       $dateFin = date('Y-m-d', strtotime($dateDebut . ' + 2 years'));

       // Créer un tableau associatif avec les données à enregistrer
       $affectationData = [
           'nom_employee' => $request->nom_employee,
           'telephone_N' => $request->num_série,
           'date_debut' => $dateDebut,
           'date_fin' => $dateFin,
           'application1' => $request->Application1,
           'application2' => $request->Application2,
           'application3' => $request->Application3,
           'application4' => $request->Application4,
           // Ajoutez ici les autres champs d'application
           'department_name' => $departmentName, // Ajout du nom du département
       ];

       // Créer l'affectationyh
       $affectation = Affectation::create($affectationData);

       // Créer l'historique d'affectation
       AffectationHistory::create([
           'affectation_id' => $affectation->id,
           'action' => 'Création',
           'user' => 'ff', // À modifier selon vos besoins
           // Enregistrez toutes les données de l'affectation
           'nom_employee' => $affectation->nom_employee,
           'telephone_N' => $affectation->telephone_N,
           'application1' => $affectation->application1,
           'application2' => $affectation->application2,
           'application3' => $affectation->application3,
           'application4' => $affectation->application4,
           'date_debut' => $affectation->date_debut,
           'date_fin' => $affectation->date_fin,
           'department_name' => $departmentName, // Ajout du nom du département
       ]);

       return redirect()->route('affectations.index')->with('success', 'Affectation added successfully.');
   } else {
       // Gérer le cas où l'employé n'existe pas ou n'a pas de département associé
       return redirect()->route('affectations.index')->with('error', 'Employee not found or has no department associated.');
   }
}


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $affectation = Affectation::with(['employee', 'telephone'])->findOrFail($id);
        return view('affectations.show', compact('affectation'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $employees = Employee::all();
        $telephones = Telephone::all();
        $affectation=Affectation::findOrFail($id);
        $Applications= Application::all();
        return view('add_affectation', compact('affectation','employees','telephones','Applications'));
       
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $affectation = Affectation::findOrFail($id);
        $dateDebut = $request->date_debut;
        $dateFin = date('Y-m-d', strtotime($dateDebut . ' + 2 years'));
    
        // Créer un tableau associatif avec les données à enregistrer
        $affectationData = [
            'nom_employee' => $request->nom_employee,
            'telephone_N' => $request->num_série,
            'date_debut' => $dateDebut,
            'date_fin' => $dateFin,
            'application1' => $request->Application1,
            'application2' => $request->Application2,
            'application3' => $request->Application3,
            'application4' => $request->Application4,
            // Ajoutez ici les autres champs d'application
        ];
    
       

        $affectation->update($affectationData);

        return redirect()->route('affectations.index')->with('success', 'Affectation updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Affectation::destroy($id);
        return redirect()->route('affectations.index')->with('success', 'Affectation deleted successfully.');
    }
    public function export()
    {
        return Excel::download(new AffectationsExport, 'affectations.xlsx');
    }
   
}

<?php

namespace App\Http\Controllers;
use App\Models\AffectationHistory;
use Illuminate\Http\Request;
use App\Models\Employee;

class AffectationHistoryController extends Controller
{
    


public function index(string $cin)
    {
    }
    public function show($cin)
{
    // Votre logique pour afficher une affectation spécifique
    
        // Récupérer l'historique des affectations
        $employee = Employee::where('cin', $cin)->first();

        if (!$employee) {
            // Si aucun employé correspondant au CIN n'est trouvé, rediriger ou renvoyer une réponse d'erreur
            return redirect()->back()->with('error', 'Aucun employé trouvé avec ce CIN.');
        }

        // Récupérer l'historique des affectations pour cet employé
        $history = AffectationHistory::where('nom_employee', $employee->cin)->get();


        // Rendre la vue avec les données de l'historique des affectations
        return view('history', compact('history'));
}
}

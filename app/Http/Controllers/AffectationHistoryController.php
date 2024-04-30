<?php

namespace App\Http\Controllers;
use App\Models\AffectationHistory;
use Illuminate\Http\Request;
use App\Models\Employee;

class AffectationHistoryController extends Controller
{



public function index(string $code_matricule)
    {
    }
    public function show($code_matricule)
{
    // Votre logique pour afficher une affectation spécifique

        // Récupérer l'historique des affectations
        $employee = Employee::where('code_matricule', $code_matricule)->first();

        if (!$employee) {
            // Si aucun employé correspondant au code_matricule n'est trouvé, rediriger ou renvoyer une réponse d'erreur
            return redirect()->back()->with('error', 'Aucun employé trouvé avec ce code_matricule.');
        }

        // Récupérer l'historique des affectations pour cet employé
        $history = AffectationHistory::where('code_matricule', $employee->code_matricule)->get();


        // Rendre la vue avec les données de l'historique des affectations
        return view('history', compact('history'));
}
}

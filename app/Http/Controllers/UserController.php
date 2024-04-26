<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Affiche la liste des utilisateurs.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('adduser', compact('users'));
    }

    /**
     * Affiche le formulaire de création d'un nouvel utilisateur.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $userId = Auth::id();
     
        // Récupérer l'utilisateur correspondant à l'ID
        $user = User::findOrFail($userId);
        
        return view('profile', compact('user'));
    }

    /**
     * Stocke un nouvel utilisateur dans la base de données.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nouveauMotDePasse' => 'required|string|min:6',
            'confirmerMotDePasse' => 'required|same:nouveauMotDePasse',
            'email' => 'required|email|unique:users,email',
            'nom' => 'required|string',
        ]);

        // Create a new user
        $user = new User();
        $user->password = bcrypt($request->input('nouveauMotDePasse'));
        $user->email = $request->input('email');
        $user->name = $request->input('nom');
        $user->save();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'New user added successfully');
    }

    /**
     * Affiche les détails d'un utilisateur spécifique.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
 
        return view('adduser');
    }
    public function edit()
    {
        $userId = Auth::id();

        // Récupérer l'utilisateur correspondant à l'ID
        $user = User::findOrFail($userId);
        return view('profile', compact('user'));
    }
    public function update(Request $request, $id)
    {
        // Validate the request data
        $request->validate([
            'ancienMotDePasse' => 'required|string', // Validation rules for old password
            'nouveauMotDePasse' => 'nullable|string|min:6', // Validation rules for new password, nullable as it's optional
            'confirmerMotDePasse' => 'nullable|required_with:nouveauMotDePasse|same:nouveauMotDePasse', // Validation rules for confirming new password
            'email' => 'required|email|unique:users,email,' . $id, // Validation rules for email, ensuring uniqueness except for the current user
            'nom' => 'required|string', // Validation rules for name
        ]);

        // Find the user by id
        $user = User::findOrFail($id);

        // Check if the old password matches
        if (!password_verify($request->input('ancienMotDePasse'), $user->password)) {
            return redirect()->back()->with('error', 'Ancien mot de passe incorrect');
        }

        // Update the user data
        $user->email = $request->input('email');
        $user->name = $request->input('nom');

        // Check if a new password is provided and update it
        if ($request->has('nouveauMotDePasse')) {
            $user->password = bcrypt($request->input('nouveauMotDePasse'));
        }

        // Save the updated user
        $user->save();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Profil utilisateur mis à jour avec succès');
    }
    
    // Ajoutez d'autres méthodes pour mettre à jour, éditer et supprimer des utilisateurs au besoin
}

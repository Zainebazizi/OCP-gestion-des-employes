<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class PasswordResetController extends Controller
{
    /**
     * Affiche le formulaire de demande de réinitialisation de mot de passe.
     */
    public function showForgotPasswordForm()
    {
        return view('auth.forgot-password');
    }

    /**
     * Envoie le lien de réinitialisation de mot de passe.
     */
    public function sendResetLink(Request $request)
    {
        // Validation de l'email
        $request->validate(['email' => 'required|email']);

        // Envoi du lien de réinitialisation
        $status = Password::sendResetLink($request->only('email'));

        // Répondre avec un message approprié
        if ($status === Password::RESET_LINK_SENT) {
            return back()->with(['status' => __($status)]);
        } else {
            return back()->withErrors(['email' => __($status)]);
        }
    }

    /**
     * Affiche le formulaire de réinitialisation de mot de passe.
     */
    public function showResetForm($token)
    {
        return view('auth.reset-password', ['token' => $token]);
    }

    /**
     * Réinitialise le mot de passe.
     */
    public function resetPassword(Request $request)
    {
        // Validation de la demande
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        // Réinitialisation du mot de passe
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                // Mise à jour du mot de passe
                $user->forceFill([
                    'password' => Hash::make($password),
                ])->save();

                // Déclenche l'événement PasswordReset
                event(new PasswordReset($user));
            }
        );

        // Répondre avec un message approprié
        if ($status === Password::PASSWORD_RESET) {
            return redirect()->route('login')->with('status', 'Mot de passe réinitialisé avec succès !');
        } else {
            return back()->withErrors(['email' => __($status)]);
        }
    }
}


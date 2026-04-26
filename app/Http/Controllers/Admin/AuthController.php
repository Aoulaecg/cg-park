<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;

class AuthController extends Controller
{
    private const ALLOWED_EMAIL    = 'k.raghay@cdg-cgpark.com';
    private const ALLOWED_PASSWORD = 'CGPark@Admin2026!';

    public function showLogin(): View|RedirectResponse
    {
        if (session('admin_authenticated')) {
            return redirect()->route('console.dashboard');
        }

        return view('admin.login');
    }

    public function login(Request $request): RedirectResponse
    {
        $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ], [
            'email.required'    => 'L\'adresse email est obligatoire.',
            'email.email'       => 'L\'adresse email n\'est pas valide.',
            'password.required' => 'Le mot de passe est obligatoire.',
        ]);

        $email    = $request->input('email');
        $password = $request->input('password');

        if ($email !== self::ALLOWED_EMAIL || $password !== self::ALLOWED_PASSWORD) {
            return back()->withErrors(['credentials' => 'Identifiants incorrects ou accès non autorisé.'])->withInput(['email' => $email]);
        }

        $request->session()->regenerate();
        $request->session()->put('admin_authenticated', true);
        $request->session()->put('admin_email', $email);

        return redirect()->route('console.dashboard');
    }

    public function logout(Request $request): RedirectResponse
    {
        $request->session()->forget(['admin_authenticated', 'admin_email']);
        $request->session()->regenerate();

        return redirect()->route('console.login');
    }
}

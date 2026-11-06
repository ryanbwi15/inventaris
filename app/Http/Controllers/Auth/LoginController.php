<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\View\View;

class LoginController extends Controller
{
    /**
     * Authenticate a user and redirect to the intended page.
     */
    public function store(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email', 'max:255'],
            'password' => ['required', 'string'],
        ]);

        $limiterKey = 'login:'.hash('sha256', Str::lower($credentials['email']).'|'.$request->ip());

        if (RateLimiter::tooManyAttempts($limiterKey, 5)) {
            return back()
                ->withErrors(['email' => 'Terlalu banyak percobaan login. Coba lagi dalam '.RateLimiter::availableIn($limiterKey).' detik.'])
                ->onlyInput('email');
        }

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            RateLimiter::clear($limiterKey);
            $request->session()->regenerate();

            return redirect()->intended(route('dashboard'));
        }

        RateLimiter::hit($limiterKey, 60);

        return back()
            ->withErrors(['email' => 'Email atau password salah.'])
            ->onlyInput('email');
    }

    /**
     * Display the login form.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Log out the user and invalidate the current session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}

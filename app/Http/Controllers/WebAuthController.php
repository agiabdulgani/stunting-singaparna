<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class WebAuthController extends Controller
{
    /**
     * Tampilkan halaman login
     */
    public function showLogin()
    {
        // Jika sudah login, langsung ke dashboard
        if (Auth::check()) {
            return redirect('/dashboard');
        }

        return view('auth.login');
    }


    /**
     * Tampilkan halaman register
     */
    public function showRegister()
    {
        // Jika sudah login, langsung ke dashboard
        if (Auth::check()) {
            return redirect('/dashboard');
        }

        return view('auth.register');
    }


    /**
     * Proses login web
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => [
                'required',
                'email',
            ],

            'password' => [
                'required',
                'string',
            ],
        ]);

        // Coba login
        if (Auth::attempt($credentials, $request->boolean('remember'))) {

            // Regenerasi session untuk mencegah session fixation
            $request->session()->regenerate();

            // Redirect ke halaman yang sebelumnya ingin dibuka
            return redirect()
                ->intended('/dashboard')
                ->with(
                    'success',
                    'Login berhasil. Selamat datang!'
                );
        }

        return back()
            ->withErrors([
                'email' => 'Email atau password salah.',
            ])
            ->onlyInput('email');
    }


    /**
     * Proses register web
     */
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:users,email',
            ],

            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | Buat User
        |--------------------------------------------------------------------------
        */

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make(
                $validated['password']
            ),
        ]);

        /*
        |--------------------------------------------------------------------------
        | Login otomatis setelah register
        |--------------------------------------------------------------------------
        */

        Auth::login($user);

        $request->session()->regenerate();

        return redirect('/dashboard')
            ->with(
                'success',
                'Registrasi berhasil. Selamat datang!'
            );
    }


    /**
     * Proses logout web
     */
    public function logout(Request $request)
    {
        Auth::logout();

        // Hapus session
        $request->session()->invalidate();

        // Buat CSRF token baru
        $request->session()->regenerateToken();

        return redirect('/login')
            ->with(
                'success',
                'Anda berhasil logout.'
            );
    }
}
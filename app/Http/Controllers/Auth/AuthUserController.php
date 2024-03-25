<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Console\Input\Input;

class AuthUserController extends Controller
{
    public function showLoginForm()
    {
        $data['pageTitle'] = 'Login';

        return view('auth.login', $data);
    }

    public function authenticate(Request $request)
    {

        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $remember = request('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            return redirect()->intended(route('user.dashboard'));
        }

        return back()->with('loginError', 'Login Gagal');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout(); //Melakukan logout pengguna dari sistem

        $request->session()->invalidate(); //Menghapus sesi pengguna

        $request->session()->regenerateToken(); //Membuat token baru

        return redirect()->intended(route('auth.login')); //Mengarahkan pengguna ke halaman login setelah logout berhasil
    }

}

<?php

namespace App\Http\Controllers\AdminAuth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Console\Input\Input;

class AuthAdminController extends Controller
{
    public function showLoginForm()
    {
        $data['pageTitle'] = 'Login Admin';

        return view('admin.auth.login', $data);
    }

    public function authenticate(Request $request)
    {

        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $remember = request('remember');

        if (Auth::guard('admin')->attempt($credentials, $remember)) {
            $request->session()->regenerate();

            return redirect()->intended(RouteServiceProvider::ADMIN_DASHBOARD);
        }

        return back()->with('loginError', 'Login Gagal');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::guard('admin')->logout(); //Melakukan logout pengguna dari sistem

        $request->session()->invalidate(); //Menghapus sesi pengguna

        $request->session()->regenerateToken(); //Membuat token baru

        return redirect()->intended(route('admin.login')); //Mengarahkan pengguna ke halaman login setelah logout berhasil
    }
}

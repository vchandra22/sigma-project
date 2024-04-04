<?php

namespace App\Http\Controllers\AdminAuth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthAdminController extends Controller
{
    public function create()
    {
        $data['pageTitle'] = 'Login Admin';

        return view('admin.auth.login', $data);
    }

    public function store(Request $request)
    {
        // validasi input form login
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $remember = request('remember'); // get nilai dari checkbox 'remember'

        // autentikasi menggunakan guard ('admin')
        if (Auth::guard('admin')->attempt($credentials, $remember)) {
            $request->session()->regenerate(); // regenerate session

            $user = Auth::guard('admin')->user(); // get user object

            // perikas role user
            if ($user->hasRole('admin')) {
                activity()->causedBy($user)->log($user->nama_lengkap . ' telah login');

                return redirect()->intended(RouteServiceProvider::ADMIN_DASHBOARD); // jika role admin redirect ke dashboard admin
            } elseif ($user->hasRole('mentor')) {
                activity()->causedBy($user)->log($user->nama_lengkap . ' telah login');

                return redirect()->intended(RouteServiceProvider::MENTOR_DASHBOARD); // jika role mentor redirect ke dashboard admin
            }
        }

        return back()->with('loginError', 'Login Gagal'); // jika autentikasi gagal, back to login
    }

    public function destroy(Request $request): RedirectResponse
    {

        activity()->causedBy(Auth::guard('admin')->user())->log('' . auth()->user()->nama_lengkap . ' telah logout');
        Auth::guard('admin')->logout(); //Melakukan logout admin dari sistem

        $request->session()->invalidate(); //Menghapus sesi

        $request->session()->regenerateToken(); //Membuat token baru

        return redirect()->intended(route('admin.login')); //Mengarahkan ke halaman login setelah logout berhasil
    }
}

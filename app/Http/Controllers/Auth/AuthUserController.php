<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Homepage;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Console\Input\Input;

class AuthUserController extends Controller
{

    public function create()
    {
        $data['pageTitle'] = 'Login';
        $data['homeData'] = Homepage::latest()->firstOrFail();

        return view('auth.login', $data);
    }

    public function store(Request $request)
    {
        // validasi input form login
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $remember = request('remember'); // get nilai dari checkbox 'remember'

        // autentikasi user
        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate(); // regenerate session

            return redirect()->intended(RouteServiceProvider::HOME); // diarahkan ke halaman yang sebelumnya coba diakses oleh user
        }

        return back()->with('loginError', 'Login Gagal'); // jika autentikasi gagal, back to login
    }

    public function destroy(Request $request): RedirectResponse
    {
        Auth::logout(); //Melakukan logout pengguna dari sistem

        $request->session()->invalidate(); //Menghapus sesi pengguna

        $request->session()->regenerateToken(); //Membuat token baru

        return redirect()->intended(route('auth.login')); //Mengarahkan pengguna ke halaman login setelah logout berhasil
    }
}

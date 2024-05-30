<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Homepage;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthUserController extends Controller
{

    /**
     * Menampilkan halaman login.
     */
    public function create()
    {
        $data['pageTitle'] = 'Login'; // Setel judul halaman menjadi 'Login'

        // Dapatkan data terbaru dari halaman depan untuk digunakan dalam halaman login
        $data['homeData'] = Homepage::latest()->firstOrFail();

        return view('auth.login', $data); // Kembalikan view dengan data
    }

    /**
     * Login function
     */
    public function store(Request $request)
    {
        // Validasi data yang diterima dari request
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $remember = request('remember'); // get nilai dari checkbox 'remember'

        // Autentikasi user menggunakan metode Auth::attempt()
        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate(); // regenerate session

            return redirect()->intended(RouteServiceProvider::HOME); // Mengarahkan ke halaman yang sebelumnya coba diakses oleh user
        }

        return back()->with('loginError', 'Login Gagal'); // jika autentikasi gagal, back to login
    }

    /**
     * Logout function
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::logout(); //Melakukan logout pengguna dari sistem

        $request->session()->invalidate(); //Menghapus sesi pengguna

        $request->session()->regenerateToken(); //Membuat token baru

        return redirect()->intended(route('auth.login')); //Mengarahkan pengguna ke halaman login setelah logout berhasil
    }
}

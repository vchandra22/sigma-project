<?php

namespace App\Http\Controllers\AdminAuth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthAdminController extends Controller
{

    /**
     * Menampilkan halaman login.
     */
    public function create()
    {
        $data['pageTitle'] = 'Login Admin'; // Setel judul halaman menjadi 'Login Admin'

        return view('admin.auth.login', $data); // Kembalikan view form login admin dengan data
    }

    public function store(Request $request)
    {
        // Validasi data yang diterima dari request
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $remember = request('remember'); // get nilai dari checkbox 'remember'

        // autentikasi menggunakan guard ('admin')
        if (Auth::guard('admin')->attempt($credentials, $remember)) {
            $request->session()->regenerate(); // Regenerate session

            $user = Auth::guard('admin')->user(); // Mendapatkan data user

            // Periksa role user
            if ($user->hasRole('admin')) {
                activity()->causedBy($user)->log($user->nama_lengkap . ' telah login'); // Membuat activity log login

                return redirect()->intended(RouteServiceProvider::ADMIN_DASHBOARD); // Jika role admin redirect ke dashboard admin

            } elseif ($user->hasRole('mentor')) {
                activity()->causedBy($user)->log($user->nama_lengkap . ' telah login'); // Membuat activity log login

                return redirect()->intended(RouteServiceProvider::MENTOR_DASHBOARD); // jika role mentor redirect ke dashboard mentor
            }
        }

        return back()->with('loginError', 'Login Gagal'); // Jika autentikasi gagal, back to login
    }

    public function destroy(Request $request): RedirectResponse
    {
        activity()->causedBy(Auth::guard('admin')->user())->log('' . auth()->user()->nama_lengkap . ' telah logout'); // Membuat activity log logout

        Auth::guard('admin')->logout(); //Melakukan logout admin dari sistem

        $request->session()->invalidate(); //Menghapus sesi

        $request->session()->regenerateToken(); //Membuat token baru

        return redirect()->intended(route('admin.login')); //Mengarahkan ke halaman login admin setelah logout berhasil
    }
}

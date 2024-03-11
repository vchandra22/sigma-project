<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        $data['pageTitle'] = 'Login';

        return view('auth.login', $data);
    }

    public function showRegisterForm()
    {
        $data['pageTitle'] = 'Register';
        
        return view('auth.sign-up', $data);
    }
}

<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Testing\Fluent\Concerns\Has;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request){
      $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
      ]);

      if(Auth::attempt($credentials)){
        
      dump($request->password);
        $request->session()->regenerate();
        return redirect()->route('pemasok.index');
      }

      // return back()->withErrors([
      //   'email' => 'User tidak ditemukan',
      // ]);
    }
}

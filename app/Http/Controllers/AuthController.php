<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Helpers\Mysql;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
  public function login(Request $request)
  {
      return view('auth.login');
  }

  public function logout(Request $request)
  {
      \Auth::logout();
      \Cookie::forget('id');
      return view('auth.login');
  }

    public function loginValidation(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'password' => 'required'
        ]);

        if (Auth::attempt(['name' => htmlentities($request->username), 'password' => $request->password]))
            return redirect()->route('admin.index')->withCookie(cookie('id', Auth::id(), 3600000));


        return back()->withErrors(['login' => 'Les identifiants fournis ne correspondent pas à nos données']);
    }
}

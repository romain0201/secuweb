<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Helpers\Mysql;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class AuthController extends Controller
{
  public function login(Request $request)
  {
      return view('auth.login');
  }

  public function logout(Request $request)
  {
      $cookie = \Cookie::forget('id');
      \Auth::logout();

      return Redirect::route('login')->withCookie($cookie);
  }

    public function loginValidation(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'password' => 'required'
        ]);

        if (Auth::attempt(['name' => htmlentities($request->username), 'password' => $request->password])) {
            if (Auth::user()->role != 'admin') {
                Auth::logout();
                return back()->withErrors(['login' => 'Vous n avez pas les droits pour accéder à cette page']);
            }
            else
                return redirect()->route('admin.index')->withCookie(cookie('id', Auth::id(), 3600000));
        }

        return back()->withErrors(['login' => 'Les identifiants fournis ne correspondent pas à nos données']);
    }
}

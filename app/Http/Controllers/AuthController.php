<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function getLogin()
  {
    return view('auth.login');
  }
  public function postLogin(Request $request)
  {
    if (is_numeric($request->get('email'))) {

      $credentials = ['phone' => $request->get('email'), 'password' => $request->get('password')];

    } elseif (filter_var($request->get('email'), FILTER_VALIDATE_EMAIL)) {

      $credentials = ['email' => $request->get('email'), 'password' => $request->get('password')];

    } else {

      return back()->withErrors("In validate format");
    }

    if (isset($credentials) && Auth::attempt($credentials)) {

      return redirect()->route('dashboard');

    }

    return back()->withErrors([
      'email' => 'The provided credentials do not match our records.',
    ])->onlyInput('email');

  }
}

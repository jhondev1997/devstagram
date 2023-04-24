<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
  public function index ()
  {
    return view('auth.register');
  }

  public function store(Request $request)
  {
    // dd($request);
    // dd($request->get('name'));

    // Modificar Request
    $request->request->add(['username' => Str::slug(($request->username))]);

    // todo:validacion
    $request->validate([
      'name' => ['required', 'min:2', 'max:30'],
      'username' => ['required','unique:users' , 'min:4', 'max:20'],
      'email' => ['required', 'min:6', 'unique:users', 'email', 'max:60'],
      'password' => ['required', 'min:6', 'confirmed']
    ]);

    User::create([
      'name' => $request->name,
      'username' => $request->username,
      'email' => $request->email,
      'password' => Hash::make($request->password)
    ]);

    // Autenticar
    // auth()->attempt([
    //   'email'=> $request->email,
    //   'password' => $request->password
    // ]);

    // Otra forma de autenticar
    auth()->attempt($request->only('email', 'password'));

    return redirect()->route('posts.index');
  }
}

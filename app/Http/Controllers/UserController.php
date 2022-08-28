<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\{Rol, User};

use Illuminate\Support\Facades\Hash;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
{
    public function index(){
        $this->authorize('view', User::class);

        return view('dashboard.users.index', [
            'users' => User::get()
        ]);
    }

    public function create(){
        $this->authorize('create', User::class);

        return view('dashboard.users.create', [
            'roles' => Rol::get()
        ]);
    }

    public function store(Request $req){
        $req->validate([
            'rol' => ['required', 'exists:App\Models\Rol,id'],
            'name' => ['required', 'unique:users'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'min:6'] 
        ]);

        $user = new User();

        $user->rol_id = $req->rol;
        $user->name = $req->name;
        $user->email = $req->email;
        $user->password = Hash::make($req->password);

        if(!$user->save()) return back()->with('msg', 'Occurred Error');

        return back()->with('msg', 'User created');
    }

    public function auth(Request $req){
        $req->validate([
            'email' => ['required'],
            'password' => ['required'] 
        ]);

        $isEmail = !(Validator::make(['email' => $req->email], ['email' => 'email'])->fails());

        $credentials[($isEmail ? 'email' : 'name')] = $req->email;
        $credentials['password'] = $req->password;

        if(Auth::attempt($credentials)){
            $req->session()->regenerate();
      
            return redirect()->intended('dashboard');
        }

        return back()->withInput()->with('error', 'Incorrect email or password');
    }

    public function logout(Request $req){
        Auth::logout();
        $req->session()->invalidate();
        $req->session()->regenerateToken();

        return redirect()->route('login');
    }

    public function destroy(Request $req){
        $this->authorize('destroy', User::class);

        $req->validate([
            'user' => ['required', 'exists:users,id']
        ]);

        $result = User::where('id', $req->user)->delete();

        if(!$result) return back()->with('msg', 'Occurred Error');

        return back()->with('msg', 'Deleted');
    }
}

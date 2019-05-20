<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\UnauthorizedException;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest', [
            'only' => ['login']
        ]);
    }

    public function login()
    {
        return view('pages.login');
    }

    public function store(Request $request)
    {
        if ($request->password != env('ADMIN_PASSWORD')) {
            throw new UnauthorizedException('密码错误');
        }
        $user = User::find(1);
        Auth::login($user);
        return redirect()->route('admin');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->intended('/login');
    }
}

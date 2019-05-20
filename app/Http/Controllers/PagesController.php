<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\UnauthorizedException;

class PagesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', [
            'only' => ['admin']
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function root()
    {
        return view('pages.root');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function admin()
    {
        if (Auth::user()->role != 'admin') {
            throw new UnauthorizedException('您不是管理员');
        }
        return view('pages.admin');
    }
}

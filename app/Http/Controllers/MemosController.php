<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Memo;
use Illuminate\Http\Request;

class MemosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $memos = Memo::orderBy('start', 'desc')->paginate(10);
        return view('memos.index', compact('memos'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('memos.create');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        Memo::create([
            'start' => Carbon::parse($request->start),
            'information' => $request->information,
        ]);
        return redirect()->route('memos.index');
    }

    /**
     * @param Memo $memo
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Memo $memo)
    {
        $memo->delete();
        return redirect()->route('memos.index');
    }
}

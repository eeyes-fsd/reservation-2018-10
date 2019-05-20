<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationsController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index()
    {
        if (!Auth::check() || Auth::user()->id != 1) {
            throw new AuthorizationException("This action is unauthorized", 400);
        }
        $reservations = Reservation::where('user_id' ,'<>', 1)->orderBy('created_at', 'desc')->paginate(10);
        return view('reservations.index', compact('reservations'));
    }

    /**
     * @param Reservation $reservation
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Reservation $reservation)
    {
        $this->authorize('delete', $reservation);
        return view('reservations.edit', compact('reservation'));
    }

    /**
     * @param Reservation $reservation
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Reservation $reservation, Request $request)
    {
        $this->authorize('delete', $reservation);
        $reservation->update($request->all('review'));
        return redirect()->route('reservations.index');
    }
}

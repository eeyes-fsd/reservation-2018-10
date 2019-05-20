<?php

namespace App\Http\Controllers\Api;

use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationsController extends Controller
{
    /**
     * @param Request $request
     * @return mixed
     */
    public function store(Request $request)
    {
        $attributes = $request->all();
        $attributes['user_id'] = Auth::guard('api')->user()->id;
        Reservation::create($attributes);
        return $this->response->array([
            'code' => 201,
            'msg' => 'Created',
        ]);
    }

    /**
     * @param Reservation $reservation
     * @return mixed
     * @throws \Exception
     */
    public function destroy(Reservation $reservation)
    {
        $reservation->delete();
        return $this->response->array([
            'code' => 200,
            'msg' => 'OK',
        ]);
    }
}

<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;

class StatusController extends Controller
{
    /**
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request)
    {
        $year = $request->year; $month = $request->month;
        $reservations = Reservation::where('year', $year)
            ->where('month', $month)
            ->whereNull('review')
            ->get();

        $_reservations = Reservation::where('year', $year)
            ->where('month', $month)
            ->where('review', 1)
            ->get();

        $reservations = $reservations->merge($_reservations);
        $data = [];
        foreach (range(1, days_of_month($year, $month)) as $day) {
            $tmp['year'] = (string)$year;
            $tmp['month'] = (string)$month;
            $tmp['day'] = (string)$day;
            $tmp['date'] = Carbon::createFromDate($year, $month, $day)->format('Ymd');
            if (Carbon::createFromDate($year, $month, $day)->lt(Carbon::today()) || Carbon::createFromDate($year, $month, $day)->gt(Carbon::today()->addDays(30))) {
                $tmp['status'] = -1;
                if (Carbon::createFromDate($year, $month, $day)->gt(Carbon::today()) && Carbon::createFromDate($year, $month, $day)->lt(Carbon::createFromDate(2019, 5, 1))) {
                    goto special;
                }
                goto end;
            }

            special:
            if (Carbon::createFromDate($year, $month, $day)->isSunday()) {
                $tmp['status'] = -1;
                goto end;
            }

            $reservations_in_day = $reservations->where('day', $day);
            if ($reservations_in_day->isEmpty()) {
                $tmp['status'] = 1;
                goto end;
            }
            $blocks = [];
            foreach ($reservations_in_day as $reservation) {
                if (Auth::guard('api')->check() && $reservation->user == Auth::guard('api')->user()) {
                    $tmp['status'] = 0;
                    goto end;
                }
                $blocks = array_merge($blocks, $reservation->blocks);
            }

            sort($blocks);
            if ($blocks == range(0, 7)) {
                $tmp['status'] = 3;
            } else {
                $tmp['status'] = 2;
            }

            goto end;

            end:
            $data[] = $tmp;
            continue;
        }

        return $this->response->array([
            'code' => 200,
            'msg' => 'OK',
            'data' => $data,
        ]);
    }

    public function show($id)
    {
        $date = Carbon::parse($id);
        $date_1 = Carbon::createFromDate(null, 5, 1)->firstOfMonth();
        $date_2 = Carbon::createFromDate(null, 10, 1)->firstOfMonth();
        $reservations = Reservation::where('year', $date->year)
            ->where('month', $date->month)
            ->where('day', $date->day)
            ->whereNull('review')
            ->get();

        $_reservations = Reservation::where('year', $date->year)
            ->where('month', $date->month)
            ->where('day', $date->day)
            ->where('review', 1)
            ->get();

        $reservations = $reservations->merge($_reservations);

        $data = [];
        foreach (range(0, 7) as $block) {
            $temp['block'] = $block;
            $temp['time'] = block_time($date->between($date_1, $date_2, false) ? 'summer' : 'winter', $block);
            $temp['status'] = 0;
            $temp['review'] = -1;
            foreach ($reservations as $reservation) {
                if (in_array($block, $reservation->blocks)) {
                    $temp['status'] = 1;
                    if (isset($reservation->review)) {
                        $temp['review'] = $reservation->review ? 1 : 0;
                    }
                    if (Auth::guard('api')->check() && $reservation->user == Auth::guard('api')->user()) {
                        $temp['status'] = 2;
                    }
                }
            }
            $data[] = $temp;
        }

        return $this->response->array([
            'code' => 200,
            'msg' => 'OK',
            'data' => $data,
        ]);
    }
}

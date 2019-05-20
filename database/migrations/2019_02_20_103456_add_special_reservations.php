<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Migrations\Migration;

class AddSpecialReservations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $date = Carbon::today();
        $data = [];

        while ($date->lt(Carbon::createFromDate(2019, 5, 1))) {
            $tmp = [
                'name' => 'admin',
                'user_id' => '1',
                'organization' => 'System',
                'phone' => '00011112222',
                'population' => 15,
                'year' => 2019,
                'month' => $date->month,
                'day' => $date->day,
                'blocks' => serialize([1, 4, 6]),
                'credential' => 'https://mem.eeyes.net/storage/credentials/b7L3H6lMTVm0RFGQylAxzgukjeWwSLW9KKUqYvX5.jpeg',
                'review' => 1,
            ];

            $data[] = $tmp;
            $date->addDay();
        }

        DB::table('reservations')->insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}

<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', ['namespace' => 'App\Http\Controllers\Api'], function ($api) {
    $api->get('version', function (){
        return response('This Is Reserve Api Version 1');
    });

    $api->group([
        'middleware' => 'api.throttle',
        'limit' => config('api.rate_limits.sign.limit'),
        'expires' => config('api.rate_limits.sign.expires'),
    ], function ($api){
        $api->post('authorizations', 'AuthorizationsController@store');
        $api->put('authorizations/current', 'AuthorizationsController@update');
    });

    $api->post('credentials',  function (Request $request) {
        if ($request->hasFile('credential') && $request->file('credential')->isValid()) {
            $path = $request->file('credential')->store('credentials', 'public');
            return response([
                'code' => 200,
                'msg' => 'OK',
                'url' => url('storage/' . $path),
            ]);
        }
    });
    $api->resource('status', 'StatusController', ['only' => ['index', 'show']]);
    $api->resource('reservations', 'ReservationsController', ['only' => ['store', 'destroy']]);
});

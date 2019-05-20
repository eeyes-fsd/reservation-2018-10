<?php

function route_class()
{
    return str_replace('.', '-', Route::currentRouteName());
}

function days_of_month($year, $month)
{
    return [
        '1' => '31',
        '2' => ($year % 4 == 0 && $year % 100 != 0) || $year % 400 == 0 ? 29 : 28,
        '3' => '31',
        '4' => '30',
        '5' => '31',
        '6' => '30',
        '7' => '31',
        '8' => '31',
        '9' => '30',
        '10' => '31',
        '11' => '30',
        '12' => '31',
    ][$month];
}

function block_time($weather, $block)
{
    return [
        '10:10',
        '10:30',
        '11:00',
        $weather == 'winter' ? '14:10' : '14:40',
        $weather == 'winter' ? '14:30' : '15:00',
        $weather == 'winter' ? '15:00' : '15:30',
        $weather == 'winter' ? '15:30' : '16:00',
        $weather == 'winter' ? '16:10' : '16:40',
    ][$block];
}

function get_weather($month)
{
    return $month >= 5 && $month < 10 ? 'summer' : 'winter';
}

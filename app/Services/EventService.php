<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class EventService
{
    public static function checkEventDupulication($eventDate, $startTime, $endTime){
        return DB::table('events')
        ->whereDate('start_date', $eventDate)
        ->whereTime('end_date', '>', $startTime,)
        ->whereTime('start_date', '<', $endTime)
        ->exists();
    }

    public static function countEventDupulication($eventDate, $startTime, $endTime)
    {
        return DB::table('events')
        ->whereDate('start_date', $eventDate)
        ->whereTime('end_date', '>', $startTime,)
        ->whereTime('start_date', '<', $endTime)
        ->count();
    }

    public static function jointDateAndTime($date, $time)
    {
        $joint = $date." ".$time;
        return Carbon::createFromFormat('Y-m-d H:i', $joint);
    }

    public static function getWeekEvents($startDate, $endDate)
    {
        $reservedPeople = DB::table('reservations')
        ->select('event_id', DB::raw('sum(number_of_people) as number_of_people'))
        ->whereNull('canceled_date')
        ->groupBy('event_id');

        return DB::table('events')
        ->leftJoinSub($reservedPeople, 'reservedPeople', function($join){
            $join->on('events.id', '=', 'reservedPeople.event_id');
            })
        ->whereBetween('start_date', [$startDate, $endDate])
        ->orderBy('start_date', 'desc')
        ->get();

    }

}
<?php

namespace App\Helper\Appoinment;

use Illuminate\Support\Carbon;

class timehelper
{
    public static function currenttimeanddate($appointment_time, $appointment_date)
    {
        $nowtime = carbon::now('Asia/Kathmandu');

        $appointmentdatetime = Carbon::parse($appointment_date. ' '. $appointment_time, 'Asia/Kathmandu');


        if ($appointmentdatetime->lessThanOrEqualTo($nowtime)) {
            throw new \Exception('You cannot book an appointment in the past or near to this current time.');
        }
    }
}

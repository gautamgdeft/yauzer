<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BusinessHour extends Model
{
    protected $fillable = ['business_id', 'sun_status', 'sun_open', 'sun_close', 'mon_status', 'mon_open', 'mon_close', 'tue_status', 'tue_open', 'tue_close', 'wed_status', 'wed_open', 'wed_close', 'thur_status', 'thur_open', 'thur_close', 'thur_close', 'fri_status', 'fri_open', 'fri_close', 'sat_status', 'sat_open', 'sat_close'];

    protected $hidden = [
        'sun_status', 'mon_status', 'tue_status', 'wed_status', 'thur_status', 'fri_status', 'sat_status',
    ]; 
}

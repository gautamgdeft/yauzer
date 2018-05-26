<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pricing extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'monthly_price', 'monthly_price', 'semi_annually_price', 'annually_price', 'yauzer',
    ];
}

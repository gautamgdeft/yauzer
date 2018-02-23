<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    public function user()
    {
        return $this->hasMany('App\User');
    }

    static function selectCountries()
    {
    	return Country::pluck('country_name','country_name');
    } 
}

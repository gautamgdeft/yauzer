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
    	return Country::where('id', '38')->orWhere('id', '230')->orderBy('id', 'DESC')->pluck('country_name','country_name');
    } 
}

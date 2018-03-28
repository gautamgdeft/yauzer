<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InterestedBusiness extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'business_id', 'interested_businesses',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'business_id',
    ];    

	#Relation with Business
    public function business()
    {
     return $this->belongsTo('App\BusinessListing');
    }  
}

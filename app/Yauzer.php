<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Yauzer extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'business_id', 'user_id', 'yauzer', 'rating', 'status',
    ];

    #Relation with User
    public function user()
    {
     return $this->belongsTo('App\User');
    }

	#Relation with Business
    public function business()
    {
     return $this->belongsTo('App\BusinessListing');
    }    
}

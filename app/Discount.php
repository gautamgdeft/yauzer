<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'business_id', 'discount_title', 'description', 'valid_thru', 'status',
    ];

    #Relation with User
    public function business()
    {
     return $this->belongsTo('App\User');
    }    
}

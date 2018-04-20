<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'business_id', 'title', 'price', 'membership', 'membership_plan', 'paid'
    ];


    #Relation with Business Invoices
    public function business()
    {
     return $this->belongsTo('App\BusinessListing');
    } 
}

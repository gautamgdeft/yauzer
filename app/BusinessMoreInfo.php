<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BusinessMoreInfo extends Model
{
    protected $fillable = ['business_id', 'business_info_id'];

    #Relation with Business-Listing
    public function business()
    {
     return $this->belongsTo('App\BusinessListing');
    }    

    #Relation with Business-Listing
    public function businessInfo()
    {
     return $this->belongsTo('App\BusinessInfo');
    }    
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BusinessPicture extends Model
{

    protected $fillable = ['business_id', 'avatar'];


    #Relation with Business
    public function business()
    {
     return $this->belongsTo('App\BusinessListing');
    }
}

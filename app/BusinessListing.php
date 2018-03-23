<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;

class BusinessListing extends Model
{
    use Sluggable;
    use SluggableScopeHelpers;

    protected $fillable = ['name', 'address', 'city', 'state', 'zipcode', 'country', 'phone_number', 'avatar', 'website', 'latitude', 'longitude'];

    protected $hidden = [
        'latitude', 'longitude',
    ];    

    #Relation with User
    public function user()
    {
     return $this->belongsTo('App\User');
    }

    #Relation with Yauzer
    public function yauzers()
    {
     return $this->hasMany('App\Yauzer');
    }

    #Relation with Business-Pictures
    public function business_pictures()
    {
     return $this->hasMany('App\BusinessPicture');
    }

    #Relation with Credit-Card
    public function creditcards()
    {
     return $this->hasOne('App\CreditCard');
    }      

    #Relation with Discount
    public function discounts()
    {
     return $this->hasOne('App\Discount');
    }          

    #Creating-Slugs
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }    

    public static function findBySlugOrFail($slug)
    {
         return $businessListing = BusinessListing::findBySlug($slug);
    }     
}

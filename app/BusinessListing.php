<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;

class BusinessListing extends Model
{
    use Sluggable;
    use SluggableScopeHelpers;

    protected $fillable = ['name', 'address', 'city', 'state', 'zipcode', 'country', 'phone_number', 'avatar', 'website', 'latitude', 'longitude', 'user_id', 'added_by', 'email', 'business_category', 'business_subcategory', 'status'];

    protected $hidden = [
        'latitude', 'longitude',
    ];    

    #Relation with User
    public function user()
    {
     return $this->belongsTo('App\User');
    }     

    #Relation with User
    public function business_added_by()
    {
     return $this->belongsTo('App\User', 'added_by');
    }    

    #Relation with Business-Category
    public function category()
    {
     return $this->belongsTo('App\BusinessCategory', 'business_category');
    }

    #Relation with Yauzer
    public function yauzers()
    {
     return $this->hasMany('App\Yauzer', 'business_id');
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

    #Relation with Business-Specilaity
    public function business_specialities()
    {
     return $this->hasMany('App\Speciality');
    }    

    #Relation with Intersted-Business
    public function interested_business()
    {
     return $this->hasMany('App\InterestedBusiness');
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

     public static function delete_business($business)
     {
         
        $business->yauzers()->delete();
        $business->delete();

     }        
}

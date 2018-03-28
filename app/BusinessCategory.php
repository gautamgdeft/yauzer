<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;

class BusinessCategory extends Model
{
    use Sluggable;
    use SluggableScopeHelpers;


    public function business_subcategory()
    {
        return $this->hasMany('App\BusinessSubcategory');
    }    

    public function business_listings()
    {
        return $this->hasOne('App\BusinessListing');
    }     

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'avatar', 'slug', 'status',
    ];


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
         return $businessCategory = BusinessCategory::findBySlug($slug);
    }

}

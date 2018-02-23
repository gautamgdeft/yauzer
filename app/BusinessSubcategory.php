<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;

class BusinessSubcategory extends Model
{
    use Sluggable;
    use SluggableScopeHelpers;


    public function business_category()
    {
        return $this->belongsTo('App\BusinessCategory');
    }    

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'business_category_id', 'name', 'avatar', 'slug', 'status',
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
         return $businessSubCategory = BusinessSubCategory::findBySlug($slug);
    }
}

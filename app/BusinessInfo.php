<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;

class BusinessInfo extends Model
{
    use Sluggable;
    use SluggableScopeHelpers;

    protected $fillable = ['user_id', 'name', 'status', 'slug'];    

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
         return $businessInfo = BusinessInfo::findBySlug($slug);
    }         
}

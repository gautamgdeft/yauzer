<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;

class Speciality extends Model
{

    use Sluggable;
    use SluggableScopeHelpers;

    #Creating-Slugs
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }   

            
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'business_id', 'name', 'status',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'business_id',
    ];    

	#Relation with Business
    public function business()
    {
     return $this->belongsTo('App\BusinessListing');
    }

    public static function findBySlugOrFail($slug)
    {
         return $special = Speciality::findBySlug($slug);
    }            
}

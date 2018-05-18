<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;

class BlogContributor extends Model
{
	use Sluggable;
    use SluggableScopeHelpers;


    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'status', 'slug',
    ];


    public static function findBySlugOrFail($slug)
    {
         return $contributor = BlogContributor::findBySlug($slug);
    }      

    #Relation with Blogs
    public function blogs()
    {
     return $this->hasMany('App\Blog');
    }      
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;

class Blog extends Model
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
        'blog_category_id', 'title', 'description', 'avatar', 'metatitle', 'metakeywords', 'metadescription', 'status',
    ];


    public static function findBySlugOrFail($slug)
    {
         return $blog = Blog::findBySlug($slug);
    }  


    #Relation with BlogCategory
    public function blogcategory()
    {
     return $this->belongsTo('App\BlogCategory', 'blog_category_id');
    }       
}

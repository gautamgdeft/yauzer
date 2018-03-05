<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;

class Faq extends Model
{
    use Sluggable;
    use SluggableScopeHelpers;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'question', 'answer', 'slug', 'status',
    ];


    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'question'
            ]
        ];
    }    

    public static function findBySlugOrFail($slug)
    {
         return $faq = Faq::findBySlug($slug);
    }       
}

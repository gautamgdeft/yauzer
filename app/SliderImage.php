<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;

class SliderImage extends Model
{
    use Notifiable;
    use Sluggable;
    use SluggableScopeHelpers;

    // protected $table = 'slider_images';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'avatar', 'slug', 'h1_description', 'h2_description' ,'image_alt_text', 'status',
    ];


    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'avatar'
            ]
        ];
    }

    public static function findBySlugOrFail($slug)
    {
        return $sliderImage = SliderImage::findBySlug($slug);
    }  
}

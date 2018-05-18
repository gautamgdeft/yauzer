<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SiteCms extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'description_ckeditor', 'first_section', 'second_section', 'third_section', 'copyright_info','default_bg_image','signup_bg_image','login_bg_image',
    ];
}

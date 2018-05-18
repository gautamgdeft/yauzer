<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SiteSeo extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'metatitle', 'metakeywords', 'metadescription',
    ];
}

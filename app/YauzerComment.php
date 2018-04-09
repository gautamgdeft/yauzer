<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class YauzerComment extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'yauzer_id', 'business_id', 'user_id', 'comment',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'yauzer_id', 'business_id', 'user_id',
    ];   

    #Relation with Yauzers
    public function yauzer()
    {
     return $this->belongsTo('App\Yauzer');
    }     

    #Relation with User
    public function user()
    {
     return $this->belongsTo('App\User');
    } 	         
}

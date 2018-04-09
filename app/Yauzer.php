<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Yauzer extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'business_id', 'user_id', 'yauzer', 'rating', 'ip_address', 'status',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'business_id', 'user_id',
    ];    

    #Relation with User
    public function user()
    {
     return $this->belongsTo('App\User');
    }

    #Relation with Business
    public function business()
    {
     return $this->belongsTo('App\BusinessListing');
    } 	

    #Relation with Yauzer-Comment
    public function yauzer_comment()
    {
     return $this->hasOne('App\YauzerComment');
    }  



     public static function delete_yauzer($business)
     {
         
        $business->yauzer_comment->delete();
        $business->delete();

     }      
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CreditCard extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'business_id', 'credit_card_owner_name', 'cvv', 'credit_card_number', 'credit_exp_month', 'credit_exp_year', 'status',
    ];

    protected $hidden = [
        'user_id',
    ];

    #Relation with User
    public function user()
    {
     return $this->belongsTo('App\User');
    }    

    #Relation with User
    public function business()
    {
     return $this->belongsTo('App\User');
    }

}

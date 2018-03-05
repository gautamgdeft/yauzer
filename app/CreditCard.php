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
        'user_id', 'credit_card_owner_name', 'cvv', 'credit_card_number', 'credit_exp_month', 'credit_exp_year', 'status',
    ];

    #Relation with User
    public function user()
    {
     return $this->belongsTo('App\User');
    }

}

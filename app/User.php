<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;

class User extends Authenticatable
{
    use Notifiable;
    use Sluggable;
    use SluggableScopeHelpers;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'city', 'state', 'zipcode', 'country', 'address', 'phone_number', 'age',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }    

    public static function findBySlugOrFail($slug)
    {
         return $user = User::findBySlug($slug);
    }


    /**
      * Get the roles a user has
      */
     public function roles()
     {
         return $this->belongsToMany(Role::class, 'user_roles');
     }

    /**
      * Check User Role
      */
     public function hasRole($check)
     {
         return in_array($check, array_fetch($this->roles->toArray(), 'name'));

     }

    /**
      * Get key in array with corresponding value
      *
      * @return int
      */
     private function getIdInArray($array, $term)
     {
        foreach ($array as $key => $value) {
             if ($value == $term) {
                 return $key;
             }
         }
 
         throw new UnexpectedValueException;
     }     

    /**
      * Add roles to user to make them a concierge
      */
     public function assignRole($title)
     {
         $assigned_roles = array();
 
         $roles = array_pluck(Role::all()->toArray(), 'name', 'id');

         switch ($title) {
             case 'user':
                 $assigned_roles[] = $this->getIdInArray($roles, 'user');
                 break;
             case 'owner':
                 $assigned_roles[] = $this->getIdInArray($roles, 'owner');
                 break;
             default:
                 throw new \Exception("The employee status entered does not exist");
         }
         $this->roles()->attach($assigned_roles);
     }
      


}

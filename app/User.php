<?php

namespace Corp;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function articles() {
        return $this->hasMany('Corp\Article');
    }

    public function roles() {
        return $this->belongsToMany('Corp\Role', 'user_role');
    }

    public function canDo($permission, $require = FALSE){
        if(is_array($permission)) {
            foreach($permission as $permName) {
                $permName = $this->canDo($permName);

                if($permName && !$require) {
                    return TRUE;
                } elseif(!$permName && $require) {
                    return FALSE;
                }
            }

            return $require;

        } else {
            foreach($this->roles as $role) {
                foreach($role->perms as $perm){
                    if(str_is($permission, $perm->name)) {
                        return TRUE;
                    }
                }
            }
        }
        return FALSE;
    }

    public function hasRole($name, $require = FALSE){
        
        if(is_array($name)) {
            foreach($name as $roleName) {
                $roleName = $this->hasRole($roleName);

                if($roleName && !$require) {
                    return TRUE;
                } elseif(!$roleName && $require) {
                    return FALSE;
                }
            }

            return $require;

        } else {
            foreach($this->roles() as $role) {
                if(str_is($role->name == $name)) {
                    return TRUE;
                }
            }
        }

        return FALSE;   
    }
}

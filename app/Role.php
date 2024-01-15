<?php

namespace Corp;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public function users(){
    	return $this->belongsToMany('Corp\User', 'user_role');
    }

    public function perms(){
    	return $this->belongsToMany('Corp\Permission', 'permission_role');
    }

    public function hasPermission($name, $require = FALSE){
        
        if(is_array($name)) {
            foreach($name as $permissionName) {
                $permissionName = $this->hasPermission($permissionName);

                if($permissionName && !$require) {
                    return TRUE;
                } elseif(!$permissionName && $require) {
                    return FALSE;
                }
            }

            return $require;

        } else {
            foreach($this->perms()->get() as $perm) {
                if(str_is($perm->name, $name)) {
                    return TRUE;
                }
            }
        }

        return FALSE;   
    }

    public function savePermissions($inputPermissions) {
    	if(!empty($inputPermissions)) {
    		$this->perms()->sync($inputPermissions);
    	} else {
    		$this->perms()->detach();
    	}

    	return TRUE;
    }
}

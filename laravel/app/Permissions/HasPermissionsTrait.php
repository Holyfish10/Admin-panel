<?php

namespace App\Permissions;

use App\Role;
use App\Permission;

trait HasPermissionsTrait {
    public function givePermissionsTo(... $permissions) {
        $permissions = $this->getAllPermissions($permissions);;

        if($permissions === null) {
            return $this;
        }

        $this->permissions()->saveMany($permissions);

        return $this;
    }

    public function widthdrawPermissionsTo(... $permissions)
    {
        $permissions = $this->getAllPermissions($permissions);
        $this->permissions()->detach($permissions);

        return $this;
    }

    public function refreshPermissions( ... $permissions)
    {
        $this->permissions()->detach();

        return $this->givePermissionsTo($permissions);
    }

    public function hasPermissionTo($permission)
    {
        return $this->hasPermissionTroughRole($permission) || $this->hasPermission($permission);
    }

    public function hasPermissionTroughRole($permission)
    {
        foreach($permission->roles as $role) {
            if($this->roles->contains($role)) {
                return true;
            }
        }
    }

    public function hasRole( ... $roles)
    {
        foreach($roles as $role) {
            if($this->roles->contains('slug', $role)) {
                return true;
            }
        }

        return false;
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'users_roles');
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'users_permissions');
    }

    protected function hasPermission($permission) {
        return (bool) $this->permissions->where('slug', $permission->slug)->count();
    }

    protected function getAllPermissions(array $permissions) {
        return Permission::whereIn('slug', $permissions)->get();
    }
}

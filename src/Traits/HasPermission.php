<?php
// +----------------------------------------------------------------------
// | Gayly [ GOOD GOOD STUDY DAY DAY UP ]
// +----------------------------------------------------------------------
// | Copyright (c) http://smhx.net All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: gayly <tthd@163.com>
// +----------------------------------------------------------------------

namespace Onini\Gayly\Traits;

use Illuminate\{
    Database\Eloquent\Relations\BelongsToMany,
    Support\Collection,
    Support\Facades\Storage
};

trait HasPermission
{
    /**
     * Get avatar attribute.
     *
     * @param string $avatar
     *
     * @return string
     */
    public function getAvatarAttribute($avatar)
    {
        if ($avatar) {
            return Storage::disk(config('gayly.upload.disk'))->url($avatar);
        }
        return admin_asset('/vendor/laravel-admin/AdminLTE/dist/img/user2-160x160.jpg');
    }

    /**
     * A user has and belongs to many roles.
     *
     * @return BelongsToMany
     */
    public function roles() : BelongsToMany
    {
        $pivotTable = config('gayly.database.role_users_table');
        $relatedModel = config('gayly.database.roles_model');
        return $this->belongsToMany($relatedModel, $pivotTable, 'user_id', 'role_id');
    }

    /**
     * A User has and belongs to many permissions.
     *
     * @return BelongsToMany
     */
    public function permissions() : BelongsToMany
    {
        $pivotTable = config('gayly.database.user_permissions_table');
        $relatedModel = config('gayly.database.permissions_model');
        return $this->belongsToMany($relatedModel, $pivotTable, 'user_id', 'permission_id');
    }

    /**
     * Get all permissions of user.
     *
     * @return mixed
     */
    public function allPermissions() : Collection
    {
        return $this->roles()->with('permissions')->get()->pluck('permissions')->flatten()->merge($this->permissions);
    }

    // /**
    //  * Check if user has permission.
    //  *
    //  * @param $permission
    //  *
    //  * @return bool
    //  */
    // public function can(string $permission) : bool
    // {
    //     if ($this->isAdministrator()) {
    //         return true;
    //     }
    //     if ($this->permissions->pluck('slug')->contains($permission)) {
    //         return true;
    //     }
    //     return $this->roles->pluck('permissions')->flatten()->pluck('slug')->contains($permission);
    // }
	//
    // /**
    //  * Check if user has no permission.
    //  *
    //  * @param $permission
    //  *
    //  * @return bool
    //  */
    // public function cannot(string $permission) : bool
    // {
    //     return !$this->can($permission);
    // }

    /**
     * Check if user is administrator.
     *
     * @return mixed
     */
    public function isAdministrator() : bool
    {
        return $this->isRole('administrator');
    }
    /**
     * Check if user is $role.
     *
     * @param string $role
     *
     * @return mixed
     */
    public function isRole(string $role) : bool
    {
        return $this->roles->pluck('slug')->contains($role);
    }

    /**
     * Check if user in $roles.
     *
     * @param array $roles
     *
     * @return mixed
     */
    public function inRoles(array $roles = []) : bool
    {
        return $this->roles->pluck('slug')->intersect($roles)->isNotEmpty();
    }

    /**
     * If visible for roles.
     *
     * @param $roles
     *
     * @return bool
     */
    public function visible(array $roles = []) : bool
    {
        if (empty($roles)) {
            return true;
        }
        $roles = array_column($roles, 'slug');
        return $this->inRoles($roles) || $this->isAdministrator();
    }
}

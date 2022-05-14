<?php

namespace App;

use App\Traits\FulltextSearch;
use App\Traits\Uuid;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    use Uuid;
    use FulltextSearch;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'company', 'uuid'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Relations
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user', 'user_id', 'role_id');
    }

    public function getInfoAttribute()
    {
        return $this->name .' [ '. $this->company . ' ]';
    }

    public function putRole($role)
    {
        if (is_string($role))
        {
            $role = Role::whereRoleName($role)->first();
        }
        return $this->roles()->attach($role);
    }

    public function forgetRole($role)
    {
        if (is_string($role))
        {
            $role = Role::whereRoleName($role)->first();
        }
        return $this->roles()->detach($role);
    }

    public function authorizeRoles($roles)
    {
        if (is_array($roles)) {
            return $this->hasAnyRole($roles) ||
                abort(401, 'This action is unauthorized.');
        }

        return $this->hasRole($roles) ||
            abort(401, 'This action is unauthorized.');
    }

    public function hasAnyRole($roles)
    {
        return null !== $this->roles()->whereIn('name', $roles)->first();
    }

    public function hasRole($role)
    {
        return null !== $this->roles()->where('name', $role)->first();
    }

    public function scopeGetAllUser($query, $request)
    {
        if (!empty($request->name)) {
            $columns = 'name, email';

            $query->whereRaw("MATCH ({$columns}) AGAINST (? IN BOOLEAN MODE)", $this->fullTextWildcards($request->name));
        }

        if (isset($request->is_active) && is_numeric($request->is_active)) {
            $query->where('is_active', $request->is_active);
        }

        return $query->join('role_user', 'role_user.user_id', '=',  'users.id')
                     ->where(['role_user.role_id' => 2]) //users
                     ->orderBy('users.created_at', 'DESC');

    }
}

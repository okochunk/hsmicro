<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
        'name', 'description'
    ];


    public function getUserObject()
    {
        return $this->belongsToMany(User::class)->using(RoleUser::class);
    }
}

<?php

namespace App;

use Laratrust\Models\LaratrustRole;
use App\Scopes\PermScope;

class Role extends LaratrustRole
{
    protected $guarded=[];
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new PermScope);
    }
}

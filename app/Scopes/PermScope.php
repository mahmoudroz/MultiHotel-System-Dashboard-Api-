<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Auth;
class PermScope implements Scope
{
    protected $id;

    public function __construct()
    {
        $this->id =session('hotel_id');
    }
    public function apply(Builder $builder, Model $model)
    {
        if (session('hotel_id') != null) {
            $builder->where('hotel_id',session('hotel_id'));
        }
    }
}

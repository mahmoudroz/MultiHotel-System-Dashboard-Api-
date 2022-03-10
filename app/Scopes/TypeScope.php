<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class TypeScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        if (auth()->user()->type == 1 && auth()->user()->id == 1) {
            $builder->where('user_id', '>=', 1);
        } else if (auth()->user()->type == 1) {
            $builder->where('user_id', '>', 1);
        } else {
            $builder->where('user_id', auth()->user()->id);
        }
    }
}

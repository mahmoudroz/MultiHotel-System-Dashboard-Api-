<?php

namespace App\Models;
use App\Models\Ressupervisor;
use App\Scopes\PermScope;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
class Supervisor extends Authenticatable implements JWTSubject
{
    use Notifiable;
    protected $table ='supervisors';
    protected $guarded=[];
    protected $casts=['image_path'];
    public function getImagePathAttribute()
    {
        return $this->image != null ? asset('uploads/supervisors/'.$this->image) :  asset('uploads/supervisors/default.jpg');
    }
    public function res()
    {
        return $this->hasMany(Ressupervisor::class);
    }
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new PermScope);
    }
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [
            'type'=>'supervisor',
        ];
    }
    public function hotel()
    {
        return $this->belongsTo('App\Model\Hotel','hotel_id');
    }
}

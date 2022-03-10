<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use App\Scopes\PermScope;

class Category extends Model implements TranslatableContract
{
    use Translatable;
    protected $table ='categories';
    protected $guarded=[];
    public $translatedAttributes = ['name'];
    protected $appended = ['image_path'];
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new PermScope);

    }
    public function getImagePathAttribute(){
        return $this->image != null ? asset('uploads/categories/'.$this->image) :  asset('uploads/categories/default.jpg') ;
    }

    public function hotel()
    {
        return $this->belongsTo('App\Models\Hotel');
    }
    public function unit()
    {
        return $this->hasMany(Unit::class,'category_id','id');
    }
}

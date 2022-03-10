<?php

namespace App\Models;
use App\Scopes\PermScope;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use App\Models\Category;

class Unit extends Model implements TranslatableContract
{
    use Translatable;
    protected $table ='units';
    protected $guarded=[];
    public $translatedAttributes = ['name'];
    protected $appended = ['image_path'];

    public function getImagePathAttribute(){
        return $this->image != null ? asset('uploads/units/'.$this->image) :  asset('uploads/units/default.jpg') ;
    }
    public function category()
    {
        return $this->belongsTo(Category::class,'category_id','id');
    }
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new PermScope);
    }
    public function services()
    {
        return $this->hasMany('App\Models\Service','unit_id','id');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RealEstateCategory extends Model
{
    protected $fillable = ['title','description'];

    public function realEstates(){
        return $this->belongsToMany('App\RealEstate');
    }

    public static function boot() {
        parent::boot();

        static::deleting(function($realEstateCategory) {
             $realEstateCategory->realEstates()->detach();
        });
    }

    public function setTitle($value) {
        $this->attributes['title'] = $value;
    }
    
    public function setDescription($value) {
        $this->attributes['description'] = $value;
    }
}

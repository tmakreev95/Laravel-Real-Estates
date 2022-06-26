<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['title','description'];

    public function realEstates(){
        return $this->belongsToMany('App\User');
    }
}

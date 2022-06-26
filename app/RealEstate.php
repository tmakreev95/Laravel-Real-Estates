<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RealEstate extends Model
{
    protected $fillable = ['imagePath','title','description','dimension', 'status', 'ref'];

    //Relation ManyToMany
    public function categories(){
        return $this->belongsToMany('App\RealEstateCategory');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function setUser($user)
    {
        $this->attributes['user_id'] = $user->id;
    }
    public static function boot() {
        parent::boot();

        static::deleting(function($realEstate) { // before delete() method call this
             $realEstate->categories()->detach();
        });
    }

    public function setImagePath($value) {
        $this->attributes['imagePath'] = $value;
    }

    public function setRef($value) {
        $this->attributes['ref'] = 'REF-' . $value;
    }

    public function setTitle($value) {
        $this->attributes['title'] = $value;
    }

    public function setDimension($value) {
        $this->attributes['dimension'] = $value;
    }

    public function setDescription($value) {
        $this->attributes['description'] = $value;
    }

    public function addCategory(string $category) {
        $categories = $this->getCategories();
        $categories[] = $category;
        
        $categories = array_unique($categories);
        $this->setCategories($categories);
  
        return $this;
    }
  
    /**
     * @param array $categories
     * @return $this
     */
    public function setCategories(array $categories) {
        $this->setAttribute('categories', $categories);
        return $this;
    }

    /***
     * @param $category
     * @return mixed
     */
    public function hasCategory($category) {
        return in_array($category, $this->getCategories());
    }

    /***
     * @param $categories
     * @return mixed
     */
    public function hasCategories($categories) {
        $currentCategories = $this->getCategories();
        foreach($categories as $category) {
            if(!in_array($category, $currentCategories )) {
                return false;
            }
        }
    return true;
    }

    /**
     * @return array
     */
    public function getCategories() {
        $categories = $this->getAttribute('categories');

        if (is_null($categories)) {
            $categories = [];
        }

        return $categories;
    }

     /**
     * @return array
     */
    public function getCategoriesArray() {
        $categories = $this->getAttribute('categories')->toArray();

        if (is_null($categories)) {
            $categories = [];
        }

        return $categories;
    }
}

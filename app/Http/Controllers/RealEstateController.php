<?php

namespace App\Http\Controllers;

use App\User;
use App\Role;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\RealEstate;
use App\RealEstateCategory;
use Auth;
use Session;
use Illuminate\Support\Collection;

class RealEstateController extends Controller {
  /* RealEstates by Category id */
  public function getRealEstatesById(Request $request) {
    $categories = RealEstateCategory::where('id', $request->route('id'))->get();

    foreach($categories as $category){
      $realEstates = $category->realEstates()->where('status', 'Published')->paginate(2);
      $categoryNew = $category;
    }
    
    return view('real-estates.real-estates-category')->with('realEstates', $realEstates)->with('categoryNew', $categoryNew); 
  }
  /* RealEstates by Category id */

  public function getIndex() {
    $realEstates = RealEstate::where('status', 'Published')->paginate(2);
    return view('real-estates.index', ['realEstates'=> $realEstates]);
  }

    /* Delete real estate */
  public function deleteRealEstate(Request $request) {
    $realEstate = RealEstate::where('id', $request->route('id'))->first();
    $realEstate->categories()->detach();
    $realEstate->delete();

    return redirect()->route('user.profile');
  }
  /* Delete real estate */

  /* Approve real estate */
  public function approveRealEstate(Request $request) {
    $realEstate = RealEstate::where('id', $request->route('id'))->first();
    $realEstate->status = 'Published';
    $realEstate->save();

    return redirect()->route('user.profile');
  }
  /* Approve real estate */
  
  /* Add new Real Estate */
  public function getAddNewRealEstate() {
    $categories = RealEstateCategory::all();
    return view("user.real-estate-add")->with(array('categories'=>$categories));
  }   

  public function postAddNewRealEstate(Request $request) {
    $this->validate($request, [
    //  'title' => 't|required|unique:users',
    //  'password' => 'password|min:4',
      'image' => 'mimes:jpg,jpeg,png,PNG|max:4096'
    ]);   
    

    $realEstate = new RealEstate([
      'title' => $request->input('title'),
      'description' => $request->input('description'),
      'dimension' => $request->input('dimension'),
      'imagePath' => '',   
      'ref' => '',    
      'status' => 'Pending Approve'  
    ]);   

    $user = Auth::user();
    $realEstate->setUser($user);

    $fileName = time().'.'.$request->image->extension();  
    $request->image->move(public_path('uploads'), $fileName);          
    $imagePath = url("/uploads/{$fileName}");

    $realEstate->setImagePath($imagePath);
    $realEstate->save(); 

    $categories = $request->input('categories');

    foreach($categories as $category) {
      $newCategory = RealEstateCategory::where('title', $category)->first();
      $realEstate->categories()->attach($newCategory->id);
      $realEstate->save();      
    }    
    
    $realEstate->setRef($realEstate->id);
    $realEstate->save(); 

    Auth::login($user);
    return redirect()->route('user.profile');
  }
  /* Add new real estate */


  /* Delete real estate category */
  public function deleteRealEstateCategory(Request $request) {
    $category = RealEstateCategory::where('id', $request->route('id'))->first();
    $category->realEstates()->detach();
    $category->delete();

    return redirect()->route('user.profile');
  }
  /* Delete real estate category */

  /* Add new real estate category */
  public function getAddNewRealEstateCategory() {
    return view('user.real-estate-category-add');
  }

  public function postAddNewRealEstateCategory(Request $request) {
    $this->validate($request, [      
      'title' => 'required',
      'description' => 'required'
    ]);

    $title = $request->input('title');

    if(RealEstateCategory::where('title', $request->input('title'))->first() == null) {
      $category = new RealEstateCategory([
        'title' => $request->input('title'),
        'description' => $request->input('description')
      ]);
  
      $category->save();
  
      return redirect()->route('user.profile');
    }
    else {      
      return redirect()->route('user.add.realestate.category')->withErrors(["Category with title: $title already exists!"]);
    }    
  }
  /* Add new real estate category */

  /* Edit real estate category */
  public function getEditRealEstateCategory(Request $request) {
    $category = RealEstateCategory::where('id', $request->route('id'))->first();
    return view('user.real-estate-category-edit')->with('category',$category);
  }
  public function postEditRealEstateCategory(Request $request) {
    $this->validate($request, [      
      'title' => 'required',
      'description' => 'required'
    ]);

    $category = RealEstateCategory::where('id', $request->route('id'))->first();

    $category->setTitle($request->input('title'));
    $category->setDescription($request->input('description'));
  
    $category->save();
  
    return redirect()->route('user.profile');
  }
  /* Edit real estate category */

  /* Edit real estate */
  public function getEditRealEstate(Request $request) {
    $realEstate = RealEstate::where('id', $request->route('id'))->first();
    $categories = RealEstateCategory::all();

    return view('user.real-estate-edit')->with('realEstate', $realEstate)->with('categories', $categories);
  }
  public function postEditRealEstate(Request $request) {
    $this->validate($request, [      
      'title' => 'required',
      'description' => 'required',
      'categories' => 'required'
    ]);

    $realEstate = RealEstate::where('id', $request->route('id'))->first();    

    $realEstate->setTitle($request->input('title'));
    $realEstate->setDescription($request->input('description'));
    $realEstate->setDimension($request->input('dimension'));    

    $requestCategories = $request->input('categories');    

    $realEstate->categories()->detach();

    foreach($requestCategories as $requestCategoryTitle) {
      if(!$realEstate->categories->contains('title', $requestCategoryTitle)) {
        $newCategory = RealEstateCategory::where('title', $requestCategoryTitle)->first();
        $realEstate->categories()->attach($newCategory->id);
      }       
         
      $realEstate->save();      
    } 
    

    $realEstate->save();
  
    return redirect()->route('user.profile');
  }
  /* Edit real estate category */
}

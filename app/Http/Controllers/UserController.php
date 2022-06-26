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

class UserController extends Controller {
  /* Sign In */
  public function getSignin() {
    return view('user.signin');
  }

  public function postSignin(Request $request) {
    $this->validate($request, [
      'email' => 'email|required',
      'password' => 'password|min:4'
    ]);

    if(Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')])){
      return redirect()->route('user.profile');
    }
    return redirect()->route('user.signin')->with('error', 'Wrong password or e-mail address!');
  }
  /* Sign In */

  /* Sign Up */
  public function getSignup() {
    return view('user.signup');
  }

  public function postSignup(Request $request) {
    $this->validate($request, [
      'email' => 'email|required|unique:users',
      'password' => 'password|min:4'
    ]);          
      
    $user = new User([
      'email' => $request->input('email'),
      'password' => bcrypt($request->input('password')),
      'name' => $request->input('name'),
    ]);     
    $user->save();

    //Setting default User Role on sign up
    $role = Role::where('title', 'User')->first();
    $user->roles()->attach($role->id);
    $user->save();
    //Setting default User Role on sign up

    Auth::login($user);
    return redirect()->route('user.profile');
  }
  /* Sign Up */
 

  public function getProfile() {  
    $roles = Auth::user()->roles;

    if(Auth::user()->isAdmin()) {
      $publishedRealEstates = RealEstate::where('status','Published')->get();
      $pendingApproveRealEstates = RealEstate::where('status','Pending Approve')->get();

      $categories = RealEstateCategory::all();  
      return view('user.profile', ['roles' => $roles,
       'publishedRealEstates' => $publishedRealEstates, 
       'pendingApproveRealEstates' => $pendingApproveRealEstates, 
       'categories'=> $categories]);
    }

    else {
      $realEstates = Auth::user()->realEstates;
      return view('user.profile', ['roles' => $roles, 'realEstates' => $realEstates]);

    }
    // $orders = Auth::user()->orders;
    // $orders->transform(function($order, $key){
    // $order->cart = unserialize($order->cart);
    // return $order;
    // });
    
  }
  
  public function getLogout() {
    Auth::logout();
    Session::flush();
    return redirect()->route('real-estates.index');
  }
}

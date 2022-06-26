<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', ['uses' => 'RealEstateController@getIndex', 'as' => 'real-estates.index']);


/* Real Estates Filtering by Category */
Route::get('/realestates/category/{id}', [
  'uses' => 'RealEstateController@getRealEstatesById',
  'as' => 'realestates.category'
]);
/* Real Estates Filtering by Category */


//Test Page
Route::get('/test-page', [
  'uses' => 'MailController@getTestPage',
  'as' => 'test-page'
]);
/* Contact us */
Route::get('/contact-us', [
  'uses' => 'MailController@getContactUs',
  'as' => 'contact-us'
]);

Route::post('/contact-us',[
  'uses' => 'MailController@postContactUs',
  'as' => 'contact-us'
]);
/* Contact us*/

/* Checkout */
Route::get('/checkout',[
  'uses'=> 'ProductController@getCheckout',
  'as'=> 'checkout',
  'middleware' => 'auth'
]);

Route::post('/checkout',[
  'uses' => 'ProductController@postCheckout',
  'as' => 'checkout',
  'middleware' => 'auth'
]);
/* Checkout */

/* Reduce routes */
Route::get('/remove/{id}',[
  'uses' => 'ProductController@getRemoveItem',
  'as' => 'product.remove'
]);

Route::get('/reduce/{id}',[
  'uses' => 'ProductController@getReduceByOne',
  'as' => 'product.reduceByOne'
]);

/* Reduce routes */

/* Shopping cart */
Route::get('/add-to-cart/{id}',[
  'uses' => 'ProductController@getAddToCart',
  'as' => 'product.addToCart'
]);

Route::get('/shopping-cart',[
  'uses' => 'ProductController@getCart',
  'as' => 'product.shoppingCart'
]);
/* Shopping cart */

Route::group(['prefix' => 'user'], function(){
  Route::group(['middleware' => 'guest'], function(){
    /* Sign Up */
    Route::get('/signup',[
      'uses'=>'UserController@getSignup',
      'as' => 'user.signup'
    ]);
    Route::post('/signup',[
      'uses' => 'UserController@postSignup',
      'as' => 'user.signup'
    ]);
    /* Sign Up */
    /* Sign In*/
    Route::get('/signin',[
      'uses'=>'UserController@getSignin',
      'as' => 'user.signin'

    ]);
    Route::post('/signin',[
      'uses' => 'UserController@postSignin',
      'as' => 'user.signin'
    ]);
  });

  Route::group(['middleware' => 'auth'], function(){   
    /* Add new Real Estate */
    Route::get('/add/realestate', [
      'uses' => 'RealEstateController@getAddNewRealEstate',
      'as' => 'user.add.realestate'
    ]);

    Route::post('/add/realestate',[
      'uses' => 'RealEstateController@postAddNewRealEstate',
      'as' => 'user.add.realestate'
    ]);
    /* Add new Real Estate */

    /* Edit Real Estate */
    Route::get('/edit/realestate/{id}', [
      'uses' => 'RealEstateController@getEditRealEstate',
      'as' => 'user.edit.realestate'
    ]);

    Route::post('/edit/realestate/{id}', [
      'uses' => 'RealEstateController@postEditRealEstate',
      'as' => 'user.edit.realestate'
    ]);

    /* Edit Real Estate */

    /* Add new Real Estate Category*/
    Route::get('/add/realestate/category', [
      'uses' => 'RealEstateController@getAddNewRealEstateCategory',
      'as' => 'user.add.realestate.category'
    ]);

    Route::post('/add/realestate/category', [
      'uses' => 'RealEstateController@postAddNewRealEstateCategory',
      'as' => 'user.add.realestate.category'
    ]);
    /* Add new Real Estate Category*/

    /* Edit Real Estate Category */
    Route::get('/edit/realestate/category/{id}', [
      'uses' => 'RealEstateController@getEditRealEstateCategory',
      'as' => 'user.edit.realestate.category'
    ]);

    Route::post('/edit/realestate/category/{id}', [
      'uses' => 'RealEstateController@postEditRealEstateCategory',
      'as' => 'user.edit.realestate.category'
    ]);

    /* Edit Real Estate Category */

    /* Delete Real Estate Category */
    Route::get('/delete/realestate/category/{id}', [
      'uses' => 'RealEstateController@deleteRealEstateCategory',
      'as' => 'user.delete.realestate.category'
    ]);
    /* Delete Real Estate Category */

    /* Delete real estate */
    Route::get('/delete/realestate/{id}', [
      'uses' => 'RealEstateController@deleteRealEstate',
      'as' => 'user.delete.realestate'
    ]);
    /* Delete real estate */

    /* Approve real estate */
    Route::get('/approve/realestate/{id}', [
      'uses' => 'RealEstateController@approveRealEstate',
      'as' => 'user.approve.realestate'
    ]);
    /* Approve real estate */
    

    /* Profile */
    Route::get('/profile', [
      'uses' => 'UserController@getProfile',
      'as' => 'user.profile'
    ]);    
    /* Profile */
    
    /* Log out*/
    Route::get('/logout', [
      'uses' => 'UserController@getLogout',
       'as' => 'user.logout'
       /* Log out*/
     ]);
  });
});

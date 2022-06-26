<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Product;
use Illuminate\Http\Request;
use App\Order;

use App\Http\Requests;
use Session;
use Stripe\Stripe;
use Stripe\Charge;
use Auth;

class ProductController extends Controller
{
    public function getIndex()
    {
      $products = Product::where('status', 'Approved')->first();
      return view('shop.index', ['products'=> $products]);
    }
    public function getAddToCart(Request $request, $id)
    {
      $product = Product::find($id);
      $oldCart = Session::has('cart') ? Session::get('cart') : null;
      $cart = new Cart($oldCart);
      $cart->add($product, $product->id);

      $request->session()->put('cart', $cart);
      return redirect()->route('real-estates.index');
    }

    public function getReduceByOne($id){
      $oldCart = Session::has('cart') ? Session::get('cart') : null;
      $cart = new Cart($oldCart);
      $cart->reduceByOne($id);

      if (count($cart->items) > 0) {
        Session::put('cart', $cart);
      }
      else {
        Session::forget('cart');
      }
      return redirect()->route('product.shoppingCart');
    }

    public function getRemoveItem($id){
      $oldCart = Session::has('cart') ? Session::get('cart') : null;
      $cart = new Cart($oldCart);
      $cart->removeItem($id);

      if (count($cart->items) > 0) {
        Session::put('cart', $cart);
      }
      else {
        Session::forget('cart');
      }
      return redirect()->route('product.shoppingCart');
    }

    public function getCart(){
      if (!Session::has('cart')){
        return view('shop.shopping-cart');
      }
      $oldCart = Session::get('cart');
      $cart = new Cart($oldCart);
      return view('shop.shopping-cart', ['products' => $cart->items, 'totalPrice' => $cart->totalPrice]);
    }

    public function getCheckout(){
      if (!Session::has('cart')){
        return view('shop.shopping-cart');
      }
      $oldCart = Session::get('cart');
      $cart = new Cart($oldCart);
      $total = $cart->totalPrice;
      return view('shop.checkout', ['total'=>$total]);
    }

    public function postCheckout(Request $request){
      if (!Session::has('cart')){
        return redirect() -> route('shop.shoppingCart');
      }
      $oldCart = Session::get('cart');
      $cart = new Cart($oldCart);

      Stripe::setApiKey('sk_test_Pvtvmbs6I3EMtSPvRaYH4lBM');
      try{
        $charge = Charge::create(array(
          "amount" => $cart->totalPrice * 100,
          "currency" => "usd",
          "source" => $request->input('stripeToken'),
          "description" => "Test Charge"
        ));
        $order = new Order();
        $order -> cart = serialize($cart);
        $order -> address = $request->input('address');
        $order -> name_checkout = $request->input('name_checkout');
        $order -> payment_id = $charge->id;

        Auth::user()->orders()->save($order);

      } catch (\Exception $e){
        return redirect()->route('checkout')->with('error', $e->getMessage());
      }
      Session::forget('cart');
      return redirect()->route('real-estates.index')->with('success', 'Successfully purchased products!');
    }
}

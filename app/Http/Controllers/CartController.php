<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Cart;

class CartController extends Controller
{
    public function index(){
    	$products = DB::table('products')->get();
    	// dd($products);
    	return view('index', compact('products'));
    }

    public function AddCart(Request $request, $id){
    	$product = DB::table('products')->where('id', $id)->first();
    	if($product != null){
    		$oldCart = Session('Cart') ? Session('Cart') : null;
    		$newCart = new Cart($oldCart);
    		$newCart->AddCart($product, $id);

    		$request->session()->put('Cart', $newCart);
    	}

    	return view('cart', compact('newCart'));
    }

    public function DeleteItemCart(Request $request, $id){
        $oldCart = Session('Cart') ? Session('Cart') : null;
        $newCart = new newCart($oldCart);
        $newCart->DeleteItemCart($id);
        if(count($newCart->products) > 0){
            $request->Session()->put('Cart', $newCart);
        }else{
            $request->Session()->forget('Cart');   
        }
        

        return view('cart', compact('newCart'));
    }

}

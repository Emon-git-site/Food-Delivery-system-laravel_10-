<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function addToWishlist($id)
    {
        if(Auth::check()){
            $check = Wishlist::where('user_id', Auth::id())->where('product_id', $id)->first();
            if(!$check){
                Wishlist::create([
                    'user_id' => Auth::id(),
                    'product_id' => $id
                ]);
                return response()->json(['success' => 'Added on Wishlist']);
            }else{
                return response()->json(['exist' => 'This product already add on wishlist.']);  
            }
        }else{
            return response()->json(['error' => 'Please Login first.']);
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index()
    {
        $amount = Cart::where('id_user', auth()->id())->count();
        session(['cartAmount' => $amount]);

        $newProds = Product::limit(4)->orderBy('created_at')->get();
        $mostSellProds = Product::limit(4)->orderBy('sold', 'DESC')->where("stock", ">", 0)->get();
      
        return view('welcome', ['newProds' => $newProds, 'mostSellProds' => $mostSellProds ]);
    }

    public static function navBarCat()
    {
        return Category::limit(3)->get();
    }

    public static function navBarCatItems($t)
    {
        return Product::where(
            [
                ['category', $t->id]
            ]
        )->limit(3)->get();
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use App\Category;
use App\Brands;
use Illuminate\Support\Facades\DB;
use Session;
use App\GeneralSetting;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public static function navCats(){
        $navCats = Category::with('categories')->where(['parent_id'=>0])->get();
        return $navCats;
    }
    public static function navBrands(){
        $navBrands = Brands::get();
        return $navBrands;
    }
    public static function cartData(){
        $session_id = Session::get('session_id');
        $userCart = DB::table('cart')->where(['session_id'=>$session_id])->get();
        return $userCart;
    }

    public static function generalSettings(){
        $settings = GeneralSetting::first();
        return $settings;
    }
}

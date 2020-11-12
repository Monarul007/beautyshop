<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Category;
use App\Products;

class IndexController extends Controller
{
    public function index(){
        $products = DB::table('products')
                        ->select('products.id','products.product_name','products.product_img','products.before_price','products.after_pprice','categories.name as catname')
                        ->join('categories', 'products.cat_id', '=', 'categories.id')
                        ->where('products.is_featured', '1')
                        ->limit(8)
                        ->get();
        $categories = Category::with('categories')->where(['parent_id'=>0])->get();
        
        return view('welcome')->with(compact('products','categories'));
    }

    public function products_loadmore(){          
        
        $products = DB::table('products')->select('products.id', DB::raw('substr(product_name, 1, 50) as name'), 'products.product_img', 'products.before_price', 'products.after_pprice', 'categories.name as catname')
        ->join('categories', 'products.cat_id', '=', 'categories.id')
        ->orderByRaw("RAND()")
        ->limit(44)
        ->get();
        
        $prod_array = array();
        $i = 1;
                    
        foreach($products as $prod){  
            $id = $prod->id;
            $name = $prod->name;
            $bprice = $prod->before_price;
            $aprice = $prod->after_pprice;
            $image = $prod->product_img;
            $catname = $prod->catname;
                        
            $src = "images/products/".$image;
            $href = "products/".$id;
                        
            $prod_array[$i] = '<div class="col-lg-3 col-md-4 col-sm-4 col-xs-6">
                <div class="single-product">
                    <div class="product-img">
                        <span class="pro-label new-label">new</span>
                        <a href="'.$href.'"><img src="'.$src.'" alt=""></a>
                        <div class="product-action clearfix">
                            <a href="#" data-toggle="tooltip" data-placement="top" title="Wishlist"><i class="fa fa-heart"></i></a>
                            <a href="#" data-toggle="tooltip" data-placement="top" title="Quick View"><i class="fa fa-search-plus"></i></a>
                            <a href="#" data-toggle="tooltip" data-placement="top" title="Add To Cart"><i class="fa fa-cart-plus"></i></a>
                        </div>
                    </div>
                    <div class="product-info clearfix">
                        <div class="fix">
                            <p class="floatright hidden-sm">'.$catname.'</p>
                            <h4 class="post-title text-left"><a href="'.$href.'">'.$name.'</a></h4>
                        </div>
                        <div class="fix">
                            <span class="pro-price text-left">£ '.$aprice.' <span>£ '.$bprice.'</span></span>
                            <span class="pro-rating float-right">
                                <a href="#"><i class="fa fa-star"></i></a>
                                <a href="#"><i class="fa fa-star"></i></a>
                                <a href="#"><i class="fa fa-star"></i></a>
                                <a href="#"><i class="fa fa-star-half-o"></i></a>
                                <a href="#"><i class="fa fa-star-half-o"></i></a>
                            </span>
                        </div>
                    </div>
                </div>
            </div>';
            $i = $i + 1;
        }          
        return $prod_array;
    }

}

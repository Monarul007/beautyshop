<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Category;
use App\Brands;
use App\Products;
use App\GeneralSetting;

class PagesController extends Controller
{
    public function index(){

        $categories = Category::with('categories')->where(['parent_id'=>0])->get();

        $products = DB::table('products')
                        ->select('products.id',DB::raw('substr(product_name, 1, 45) as name'),'products.product_img','products.before_price','products.after_pprice','categories.name as catname','categories.description as catdesc')
                        ->join('categories', 'products.cat_id', '=', 'categories.id')
                        ->orderBy('id','DESC')
                        ->paginate(6);
        $latests = DB::table('products')
                        ->limit(5)
                        ->get();
        
        return view('shop')->with('categories',$categories)->with('products',$products)->with('latests',$latests);
    }

    public function products($url = null){

        $countCat = Category::where(['url' => $url])->count();
        if($countCat == 0){
            abort(404);
        }

        $categories = Category::with('categories')->where(['parent_id'=>0])->get();
        $latests = DB::table('products')->select('products.id',DB::raw('substr(product_name, 1, 40) as name'),'products.product_img','products.before_price','products.after_pprice')
        ->limit(5)
        ->get();
        $catDatas = Category::with('categories')->where(['url' => $url])->first();
        
        $productDatas = Products::where(['cat_id' => $catDatas->id])
        ->select('products.id',DB::raw('substr(product_name, 1, 45) as name'),'products.product_img','products.before_price','products.after_pprice','categories.name as catname')
        ->join('categories', 'products.cat_id', '=', 'categories.id')
        ->paginate(9);

        $taglessdesc = strip_tags($catDatas->description);
        $productCount = $productDatas->count();

        return view('category')->with(compact('categories','latests','catDatas','taglessdesc','productDatas','productCount'));
    }

    public function brands($url = null){

        $countBrand = Brands::where(['url' => $url])->count();
        if($countBrand == 0){
            abort(404);
        }
        $categories = Category::with('categories')->where(['parent_id'=>0])->get();

        $latests = DB::table('products')->select('products.id',DB::raw('substr(product_name, 1, 40) as name'),'products.product_img','products.before_price','products.after_pprice')
        ->limit(5)
        ->get();

        $brands = Brands::where(['url' => $url])->first();
        
        $brandDatas = Products::where(['brand_id' => $brands->id])
        ->select('products.id',DB::raw('substr(product_name, 1, 45) as name'),'products.product_img','products.before_price','products.after_pprice','brands.name as bname', 'brands.image as bimage', 'brands.description as description')
        ->join('brands', 'products.brand_id', '=', 'brands.id')
        ->paginate(9);

        $taglessdesc = strip_tags($brands->description);
        $prodCount = $brandDatas->count();

        return view('brands')->with(compact('categories','latests','brandDatas','brands','taglessdesc','prodCount'));
    }

    public function general_settings(){
        
        $settings = GeneralSetting::first();
        return view('admin.settings')->with('settings', $settings);
        
    }

    public function general_settings_save(Request $req){
        
        $siteName    = $req['siteName'];
        $siteTagline = $req['siteTagline'];
        $phone       = $req['phone'];
        $siteAddress = $req['siteAddress'];
        $email       = $req['email'];
        
        $general_settings = GeneralSetting::find('1');
        
        $general_settings->site_name    = $siteName;
        $general_settings->site_tagline = $siteTagline;
        $general_settings->site_address = $siteAddress;
        $general_settings->phone        = $phone;
        $general_settings->email        = $email;
        
        if($req->hasFile('favicon')){
            
            $file = $req->file('favicon');
            $basename = basename($file);
            $img_name = $basename.time().'.'.$file->getClientOriginalExtension();
            $file->move('public/images/theme/', $img_name);
            $general_settings->favicon = $img_name;
        }
        
        if($req->hasFile('logoSmall')){
            
            $file1 = $req->file('logoSmall');
            $basename1 = basename($file1);
            $img_name1 = $basename1.time().'.'.$file1->getClientOriginalExtension();
            $file1->move('public/images/theme/', $img_name1);
            $general_settings->logo_small = $img_name1;
            
        }
        if($req->hasFile('logoBig')){
            
            $file2 = $req->file('logoBig');
            $basename2 = basename($file2);
            $img_name2 = $basename2.time().'.'.$file2->getClientOriginalExtension();
            $file2->move('public/images/theme/', $img_name2);
            $general_settings->logo_big = $img_name2;
        }
        
        $general_settings->save();
        
        return back();
    }

    public function search(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();

            $search_products = $data['search'];
            $products = Products::select('products.id',DB::raw('substr(product_name, 1, 45) as name'),'products.product_img','products.before_price','products.after_pprice','categories.name as catname','categories.description as catdesc')
            ->join('categories', 'products.cat_id', '=', 'categories.id')->where('product_name', 'like','%'.$search_products.'%')->orwhere('product_code',$search_products)->orderBy('id','DESC')
            ->paginate(6);

            $categories = Category::with('categories')->where(['parent_id'=>0])->get();
            $latests = DB::table('products')->limit(5)->get();
            
            return view('shop')->with(compact('search_products','products','categories','latests'));
        }
    }
}

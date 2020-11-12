<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Products;
use App\Category;
use App\Brands;
use App\ProductAttributes;
use App\ProductImages;
use App\Coupon;
use Session;

class ProductsController extends Controller
{
    public function addProduct(Request $request){
        $category = Category::orderBy('name', 'ASC')->get();
        $brands = Brands::orderBy('name', 'ASC')->get();

        if($request->isMethod('post')){

            $slug = Str::slug($request->inputName);
            $slug_count = Products::where('slug', $slug)->count();
            if($slug_count > 0){
                $x = Date('ms')."-".rand(1000,10000);
                $slug = $slug.$x;
            }
            $data = $request->all();
            $product = new Products;
            $product->cat_id = $data['inputCategory'];
            $product->brand_id = $data['inputBrand'];
            $product->product_name = $data['inputName'];
            $product->slug = $slug;
            $product->product_desc = $data['inputDescription'];
            $product->product_specs = $data['inputSpecs'];
            $product->main_feature = $data['inputFeature'];
            $product->before_price = $data['inputPrice'];
            $product->after_pprice = $data['DiscountPrice'];
            $product->product_code = $data['inputCode'];
            $product->product_size = $data['inputSize'];
            $product->sku = $data['inputSKU'];
            $product->stock = $data['inputStock'];
            $product->is_featured = $data['inputStatus'];

            if($request->hasFile('inputImage')){
                $file = $request->file('inputImage');
                $basename = basename($file);
                $img_name = $basename.time().$file->getClientOriginalExtension();
                $file->move('images/products/', $img_name);
                $product->product_img = $img_name;
            }
            $product->save();

            $DataProduct = Products::where('slug', $slug)->first();
            $pro_id = $DataProduct['id'];
            $attribute = new ProductAttributes;
            $attribute->product_id = $pro_id;
            $attribute->sku = $data['inputSKU'];
            $attribute->weight = $data['inputSize'];
            $attribute->price = $data['DiscountPrice'];
            $attribute->stock = $data['inputStock'];
            $attribute->save();

            if($request->hasfile('addImage')){
                foreach($request->file('addImage') as $image){
                    $basename = basename($image);
                    $name = $basename.time().$image->getClientOriginalExtension();
                    $image->move('images/products/', $name);
                    $dataerr[] = $name;
                }
            }
            $get_product = Products::where('slug', $slug)->first();
            $product_id = $get_product['id'];
            $form= new ProductImages;
            $form->product_id = $product_id;
            $form->images=json_encode($dataerr);
            $form->save();

            return redirect('/admin/add_product')->with('flash_message_success', 'Product Created Successfully!');
        }

        return view('admin.add_product')->with('category', $category)->with('brands', $brands);
    }

    public function ViewProducts(){
        $products = Products::orderBy('product_name', 'DESC')->get();
        $categories = Category::orderBy('name', 'ASC')->get();
        $brands = Brands::orderBy('name', 'ASC')->get();
        return view('admin.view_products')->with('products', $products)->with('categories', $categories)->with('brands', $brands);
    }

    public function editProduct(Request $req, $id = null){
        $products = Products::where(['id'=>$id])->get();
        $categories = Category::orderBy('name', 'ASC')->get();
        $catArray = [];
        if($categories != null){
            foreach($categories as $cat){
            $catArray[] = $cat->name;
            $catArray[] = $cat->id;
                $subcats = Category::orderBy('id','ASC')->where('parent_id', $cat->id )->get();
                if($subcats != null){
                    foreach($subcats as $subcat){
                        $catArray[] = $cat->name.">".$subcat->name;
                        $catArray[] = $subcat->id;
                    }
                }
            }
        }
        $brands = Brands::orderBy('name', 'ASC')->get();
        if($req->isMethod('post')){
            $data = $req->all();
            Products::where(['id'=>$id])->update(['cat_id'=>$data['inputCategory'],'brand_id'=>$data['inputBrand'],'product_name'=>$data['inputName'],'product_desc'=>$data['inputDescription'],'product_specs'=>$data['inputSpecs'],'before_price'=>$data['inputPrice'],'after_pprice'=>$data['DiscountPrice'],'product_code'=>$data['inputCode'],'sku'=>$data['inputSKU'],'product_size'=>$data['inputSize'],'stock'=>$data['inputStock'],'is_featured'=>$data['inputStatus']]);
            
            $DataProduct = Products::where('id', $id)->first();
            $getSKU = $DataProduct['sku'];
            ProductAttributes::where(['sku'=>$getSKU])->update(['sku'=>$data['inputSKU'],'weight'=>$data['inputSize'],'stock'=>$data['inputStock'],'price'=>$data['DiscountPrice']]);
            $product = Products::find($id);
            if($req->hasFile('inputImage')){
                $prev_img = $product->product_img;
                $image_path = 'images/products/'.$prev_img;
                if(file_exists($image_path)) {
                     @unlink($image_path);
                }
                $file = $req->file('inputImage');
                $basename = basename($file);
                $img_name = $basename.time().'.'.$file->getClientOriginalExtension();
                $file->move('images/products/', $img_name);
                $product->product_img = $img_name;
            }
            $product->save();
            return redirect('/admin/view_products')->with('flash_message_success', 'Product Updated Successfully!');
        }
        return view('admin.edit_product')->with('products', $products)->with('catArray', $catArray)->with('brands', $brands)->with('id', $id);
    }

    public function deleteProduct($id)
    {
        $delete = Products::where('id', $id)->delete();
        if ($delete == 1) {
            $success = true;
            $message = "Product deleted successfully!";
        } else {
            $success = true;
            $message = "Product not found";
        }
        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
    }

    public function createAttribute(Request $request, $id = null){
        $product = Products::with('attributes')->where(['id'=>$id])->first();
        if($request->isMethod('post')){
            $data = $request->all();
            foreach($data['sku'] as $key => $val){
                if(!empty($val)){
                    $attrCountSKU = ProductAttributes::where('sku',$val)->count();
                    if($attrCountSKU>0){
                        return redirect('/admin/create_attribute/'.$id)->with('flash_message_error', 'Attribute With This SKU Alraedy Exist!');
                    }
                    $attrCountSizes = ProductAttributes::where(['product_id'=>$id,'weight'=>$data['weight'][$key]])->count();
                    if($attrCountSizes>0){
                        return redirect('/admin/create_attribute/'.$id)->with('flash_message_error', ''.$data['weight'][$key].' Weight Already Exists! Please try different weight attribute!');
                    }
                    $attribute = new ProductAttributes;
                    $attribute->product_id = $id;
                    $attribute->sku = $val;
                    $attribute->weight = $data['weight'][$key];
                    $attribute->price = $data['price'][$key];
                    $attribute->stock = $data['stock'][$key];
                    $attribute->save();
                }
            }
            return redirect('/admin/create_attribute/'.$id)->with('flash_message_success', 'Attribute Created Successfully!');
        }
        return view('admin.create_attribute')->with('product', $product);
    }

    public function deleteAttribute($id)
    {
        $delete = ProductAttributes::where('id',$id)->delete();
        if ($delete == 1) {
            $success = true;
            $message = "Attribute deleted successfully!";
        } else {
            $success = true;
            $message = "Attribute not found";
        }
        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
    }

    public function singleProduct($id = null){
        $singleProduct = Products::with('attributes','images')->where(['id'=>$id])->first();
        $subStrSpecs = substr($singleProduct->product_specs, 24, 300);
        $totalStock = ProductAttributes::where('product_id',$id)->sum('stock');
        $relatedProducts = Products::where('id', '!=', $id)->where(['cat_id' => $singleProduct->cat_id])->get();
        return view('products')->with(compact('singleProduct','subStrSpecs','totalStock','relatedProducts'));
    }

    public function productPrice(Request $request){
        $data = $request->all();
        $proArr = explode("-",$data['idWeight']);
        $proAtt = ProductAttributes::where(['product_id' => $proArr[0], 'weight' => $proArr[1]])->first();
        echo $proAtt->price;
        echo "#";
        echo $proAtt->stock;
    }

    public function addtoCart(Request $request){

        Session::forget('CouponAmount');
        Session::forget('CouponCode');

        $data = $request->all();
        
        if(empty($data['user_email'])){
            $data['user_email'] = '';
        }
        if(empty($data['inputSize'])){
            return redirect()->back()->with('flash_message_error', 'Please Select Product Weight or Size!');
        }

        if(empty($data['session_id'])){
            $data['session_id'] = '';
        }

        $weightArr = explode("-",$data['inputSize']);

        $getAttStock = ProductAttributes::select('stock')->where(['product_id' =>$data['inputId'], 'weight' => $weightArr[1]])->first();
        if($data['inputQTY'] > $getAttStock->stock){
            return redirect()->back()->with('flash_message_error', 'Required Quantity for this product not availablle!');
        }

        $session_id = Session::get('session_id');
        if(empty($session_id)){
            $session_id = Str::random(40);
            Session::put('session_id',$session_id);
        }

        $countProducts = DB::table('cart')->select('product_code')->where(['product_id'=>$data['inputId'],'product_name'=>$data['inputName'],'weight'=>$weightArr[1],'session_id'=>$session_id])->count();
        if($countProducts>0){
            return redirect()->back()->with('flash_message_error', 'This Product Already Added to Cart! Try adding with another weight or size.');
        }else{

            $getSKU = ProductAttributes::select('sku')->where(['product_id' =>$data['inputId'], 'weight' => $weightArr[1]])->first();

            DB::table('cart')->insert(['product_id'=>$data['inputId'],'product_name'=>$data['inputName'],'image'=>$data['inputImage'],'product_code'=>$getSKU->sku,'product_color'=>$data['inputColor'],'price'=>$data['inputPrice'],'weight'=>$weightArr[1],'quantity'=>$data['inputQTY'],'user_email'=>$data['user_email'],'session_id'=>$session_id,'created_at'=>NOW()]);
        }

        return redirect()->back()->with('flash_message_success', 'Product Added to Cart Successfully!');

    }

    public function cart(){
        $session_id = Session::get('session_id');
        $userCart = DB::table('cart')->where(['session_id'=>$session_id])->get();
        foreach($userCart as $key => $product){
            $productData = Products::where('id',$product->product_id)->first();
            $userCart[$key]->image = $productData->product_img;
        }
        return view('cart')->with(compact('userCart'));
    }

    public function deleteCartProduct($id = null){

        Session::forget('CouponAmount');
        Session::forget('CouponCode');

        DB::table('cart')->where('id',$id)->delete();
        return redirect('cart')->with('flash_message_success', 'Product Deleted From Cart Successfully!');
    }

    public function updateCartProduct(Request $request){

        Session::forget('CouponAmount');
        Session::forget('CouponCode');
        
        $qty = $request->newQTY;
        $rowId = $request->rowID;
        DB::table('cart')->where(['id'=>$rowId])->update(['quantity'=>$request->newQTY]);
        echo 'Cart Quantity Updated Successfully!';
    }
    
    public function updateCart($id=null, $quantity=null){
        $getCartDetails = DB::table('cart')->where('id',$id)->first();
        $getAttStock = ProductAttributes::where('sku',$getCartDetails->product_code)->first();
        $updatedQty = $getCartDetails->quantity+$quantity;
        if($getAttStock->stock >= $updatedQty){
            DB::table('cart')->where(['id'=>$rowId])->update(['quantity'=>$request->newQTY]);
        }else{
            return redirect('cart')->with('flash_message_error', 'Required Quantity is not Available.');
        }
        echo 'Cart Quantity Updated Successfully!';
    }

    public function applyCoupon(Request $requset){
        Session::forget('CouponAmount');
        Session::forget('CouponCode');

        $data = $requset->all();
        // echo "<pre>"; print_r($data); die;
        $couponCheck = Coupon::where('coupon_code',$data['inputCoupon'])->count();
        if($couponCheck == 0){
            return redirect()->back()->with('flash_message_error', 'Oops! Coupon Code You Entered Is Not Valid!');
        }else{
            $getDetails = Coupon::where('coupon_code',$data['inputCoupon'])->first();
            if($getDetails->status == 0){
                return redirect()->back()->with('flash_message_error', 'Oops! Coupon Code You Entered Is Not Active Anymore!');
            }
            $checkExpiry = $getDetails->expiry_date;
            $CurrentDate = date('Y-m-d');
            if($checkExpiry < $CurrentDate){
                return redirect()->back()->with('flash_message_error', 'Oops! Coupon Code Expired!');
            }

            $session_id = Session::get('session_id');
            $userCart = DB::table('cart')->where(['session_id'=>$session_id])->get();
            $total_amount = 0; 
			foreach($userCart as $item){
				$total_amount = $total_amount + ($item->price * $item->quantity);
            }
            
            if($getDetails->amount_type=="fixed"){
                $couponAmount = $getDetails->amount;
            }else{
                $couponAmount = $total_amount * ($getDetails->amount/100);
            }
            Session::put('CouponAmount',$couponAmount);
            Session::put('CouponCode',$data['inputCoupon']);
            return redirect()->back()->with('flash_message_success', 'Success! Coupon Code Applied Successfully. You availed the discounted amount!');
        }
    }

}
